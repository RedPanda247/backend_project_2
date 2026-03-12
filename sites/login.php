<?php

include '../tools/common.php';

include_header();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../site_scripts/db.php';
}

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    // Get all usenames from database
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $mysqli->prepare('SELECT id, password_hash, username FROM users WHERE username = ? LIMIT 1');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $password_hash, $db_username);
    $stmt->store_result();

    if ($stmt->num_rows !== 1) {
        $stmt->close();
        add_flash_message("Incorrect username or password");
        reload();
    }

    if (password_verify($password, $password_hash)) {
        $stmt->close();

        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $db_username;

        header('Location: home.php');
        exit;
    } else {
        $stmt->close();
        add_flash_message("Incorrect username or password");
        reload();
    }


} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If the user submitted the form but no fields were filled out
    add_flash_message("Please fill out all fields");
    reload();
}

include_flash_message();

?>



<div class="login-signup-card">
    <h2>Login</h2>
    <form method="post">
        <label>Username<input name="username" type="text" placeholder="Username"></label>
        <label>Password<input name="password" type="password" placeholder="******"></label>
        <button type="submit">Login</button>
    </form>
    <h4>Don't have an account? Signup <a href="signup.php">here</a></h4>
</div>

<?php
include '../components/footer.php'
    ?>