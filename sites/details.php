<?php
include_once '../tools/common.php';

assert_session();


include_header("../styles/details.css");


// Get game id
if (!isset($_GET['game'])) {
    die("No game selected");
}

$game_id = $_GET['game'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment']) && isset($_SESSION['user_id'])) {
    include __DIR__ . "/../site_scripts/db.php";
    $sql = "INSERT INTO comments (text, commenter, game_id) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sii', $_POST['comment'], $_SESSION['user_id'], $game_id);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();
    // Redirect to prevent resubmission
    header("Location: " . $_SERVER['PHP_SELF'] . "?game=" . $game_id);
    exit;
}

// Get game data
$games = get_games_from_database(null);

$game_data;

foreach ($games as $game) {
    if ($game['id'] == $game_id) {
        $game_data = $game;
        break;
    }
}

// Die if game data was unable to be fetched
if (empty($game_data)) {
    die("Couldn't get game data");
}



?>
<div class="content">
    <img src="<?php echo $game_data['background_image']; ?>" alt="Game image">
    <div class="info">
        <h1><?php echo $game_data['name']; ?></h1>
        <div class="platforms row">
            <?php foreach ($game_data["parent_platforms"] as $platform) {
                ?>
                <img src="<?php echo "../images/icons/" . $platform . ".svg" ?>" alt="platform logo">
                <?php
                // echo $platform;
            } ?>
        </div>
        <div class="genres row">
            <h3>Genre: </h3>
            <?php foreach ($game_data["genres"] as $genre) {
                ?>
                <h4><?php echo $genre; ?></h4>
                <?php
            } ?>
        </div>
        <div class="stores row">
            <h3>Store: </h3>
            <?php foreach ($game_data["stores"] as $store) {
                ?>
                <h4><?php echo $store; ?></h4>
                <?php
            } ?>
        </div>
        <div class="icon-info">
            <div class="rating">
                <img src="../images/icons/star.svg" alt="star">
                <h3><?php echo $game_data["rating"] ?></h3>
            </div>
            <div class="comments-icon">
                <img src="../images/icons/chat-icon.svg" alt="chat bubble">
                <h3><?php echo count($game_data['comments']) ?></h3>
            </div>
            <div class="playtime">
                <img src="../images/icons/timer.svg" alt="timer">
                <h3><?php echo $game_data["playtime"] . "h" ?></h3>
            </div>
        </div>
    </div>
    <div class="comments-area">
        <h2>Comments</h2>
        <form method="post">
            <input type="text" name="comment">
            <button type="submit">Comment</button>
        </form>
        <div class="comments">
            <?php
            include __DIR__ . "/../site_scripts/db.php";

            // SQL
            $sql = "SELECT * FROM comments WHERE game_id = ? ORDER BY created_at DESC";
            $stmt = $mysqli->prepare($sql);
            // Bind to prevent injection
            $stmt->bind_param('i', $game_id);
            // Execute
            $stmt->execute();
            // Get result and put in comments variable
            $result = $stmt->get_result();
            $comments = $result->fetch_all(MYSQLI_ASSOC);




            foreach ($comments as $comment) {
                // SQL
                $sql = "SELECT username FROM users WHERE id = ?";
                $stmt = $mysqli->prepare($sql);

                // Bind to prevent injection
                $stmt->bind_param('i', $comment['commenter']);

                $stmt->execute();
                // Get result and put in comments variable
                $result = $stmt->get_result();
                $username = $result->fetch_assoc();
                ?>
                <div class="comment">
                    <div class="top">
                        <h4><?php echo htmlspecialchars($username['username']); ?></h4>
                        <h6><?php echo $comment['created_at'] ?></h6>
                    </div>
                    <div class="bottom">
                        <h3><?php echo $comment['text'] ?></h3>
                    </div>
                </div>
                <?php
            }
            // Close connection
            $stmt->close();
            ?>
        </div>
    </div>
</div>