<?php
function assert_session()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function local_api_fetch($api)
{
    // Start output buffering
    ob_start();

    // Run api php file
    include $api;

    // Get its output
    $output = ob_get_clean();

    // Decode json
    $response = json_decode($output, true);

    return $response;
}

function include_header($optional_css_path = null)
{
    include '../components/header.php';
}

function include_flash_message()
{
    include 'flash.php';
}

function add_flash_message($message)
{
    $_SESSION["flash_messages"][] = $message;
}

function reload()
{
    $current_page = basename($_SERVER['PHP_SELF']);
    header("Location: $current_page");
    exit;
}

function get_games_from_local_api()
{
    $result = local_api_fetch(__DIR__ . "/../data/games_data.json");
    if ($result !== null) {
        $games = $result["results"];
        return $games;
    } else {
        return null;
    }
}

function game_card($game_data)
{
    include '../components/game_card.php';
}

function check_password_strength(string $password)
{
    // Check minimum length
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long";
    }

    // Check for uppercase
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least one uppercase letter";
    }

    // Check for lowercase
    if (!preg_match('/[a-z]/', $password)) {
        return "Password must contain at least one lowercase letter";
    }

    // Check for numbers
    if (!preg_match('/[0-9]/', $password)) {
        return "Password must contain at least one number";
    }

    // Check for special characters
    if (!preg_match('/[^A-Za-z0-9]/', $password)) {
        return "Password must contain at least one special character";
    }

    return "STRONG";
}

function get_games_from_database()
{
    include __DIR__ . "/../site_scripts/db.php";

    // Step 1: Get all games
    $sql = "SELECT * FROM games";
    $result = $mysqli->query($sql);
    $games = $result->fetch_all(MYSQLI_ASSOC);

    // Step 2: For each game, get related data
    $final_result = [];
    foreach ($games as $game) {
        $game_id = $game['game_id'];

        // Get genres
        $stmt = $mysqli->prepare("SELECT genre_name FROM games_genres WHERE game_id = ?");
        $stmt->bind_param('i', $game_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $genres = [];
        while ($row = $result->fetch_assoc()) {
            $genres[] = $row['genre_name'];
        }
        $stmt->close();

        // Get platforms
        $stmt = $mysqli->prepare("SELECT plattform_name FROM games_platforms WHERE game_id = ?");
        $stmt->bind_param('i', $game_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $platforms = [];
        while ($row = $result->fetch_assoc()) {
            $platforms[] = $row['plattform_name'];
        }
        $stmt->close();

        // Get stores
        $stmt = $mysqli->prepare("SELECT store_name FROM games_stores WHERE game_id = ?");
        $stmt->bind_param('i', $game_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stores = [];
        while ($row = $result->fetch_assoc()) {
            $stores[] = $row['store_name'];
        }
        $stmt->close();

        // Format data to match JSON structure
        $final_result[] = [
            'id' => $game['game_id'],
            'slug' => $game['slug'],
            'name' => $game['name'],
            'released' => $game['release_date'],
            'background_image' => $game['image_url'],
            'playtime' => $game['playtime'],
            'genres' => $genres,
            'platforms' => $platforms,
            'stores' => $stores
        ];
    }

    $mysqli->close();
    return $final_result;
}

function json_api_data_to_database()
{
    include __DIR__ . "/../site_scripts/db.php";

    $games = get_games_from_local_api();

    if ($games === null) {
        return false;
    }

    foreach ($games as $game) {

        // Prepare data that should be inserted, use IGNORE to prevent the same game be inserted multiple times by it's api id
        $stmt = $mysqli->prepare("INSERT IGNORE INTO games (game_id, slug, name, release_date, image_url, playtime) VALUES (?, ?, ?, ?, ?, ?)");

        // Get data from json to variables
        $game_id = $game['id'];
        $slug = $game['slug'];
        $name = $game['name'];
        $release_date = $game['released'];
        $image_url = $game['background_image'];
        $playtime = $game['playtime'];

        // Bind variables
        $stmt->bind_param('issssi', $game_id, $slug, $name, $release_date, $image_url, $playtime);

        // Execute
        $stmt->execute();
        
        $stmt->close();


        // Check if data for genres was retrieved sucessfully
        if (isset($game['genres'])) {

            // Delete old to avoid duplicate
            $mysqli->query("DELETE FROM games_genres WHERE game_id = $game_id");

            // Insert all genres
            foreach ($game['genres'] as $genre) {
                $genre_stmt = $mysqli->prepare("INSERT INTO games_genres (game_id, genre_name) VALUES (?, ?)");
                $genre_name = $genre['name'];
                $genre_stmt->bind_param('is', $game_id, $genre_name);
                if (!$genre_stmt->execute()) {
                    echo "Error inserting genre: " . $genre_stmt->error . "<br>";
                }
                $genre_stmt->close();
            }

        }

        // Check if data for platforms was retrieved sucessfully
        if (isset($game['parent_platforms'])) {

            // Delete old to avoid duplicate
            $mysqli->query("DELETE FROM games_platforms WHERE game_id = $game_id");

            // Insert all platforms
            foreach ($game['parent_platforms'] as $parent_platform) {
                $platform_stmt = $mysqli->prepare("INSERT INTO games_platforms (game_id, platform_name) VALUES (?, ?)");
                $platform_name = $parent_platform['platform']['name'];
                $platform_stmt->bind_param('is', $game_id, $platform_name);
                if (!$platform_stmt->execute()) {
                    echo "Error inserting platform: " . $platform_stmt->error . "<br>";
                }
                $platform_stmt->close();
            }

        }

        // Check if data for stores was retrieved sucessfully
        if (isset($game['stores'])) {

            // Delete old to avoid duplicate
            $mysqli->query("DELETE FROM games_stores WHERE game_id = $game_id");

            // Insert all stores
            foreach ($game['stores'] as $store) {
                $store_stmt = $mysqli->prepare("INSERT INTO games_stores (game_id, store_name) VALUES (?, ?)");
                $store_name = $store['store']['name'];
                $store_stmt->bind_param('is', $game_id, $store_name);
                if (!$store_stmt->execute()) {
                    echo "Error inserting store: " . $store_stmt->error . "<br>";
                }
                $store_stmt->close();
            }

        }
    }
}
