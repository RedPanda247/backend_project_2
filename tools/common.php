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
    $result = local_api_fetch("../data/games_data.json");
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

