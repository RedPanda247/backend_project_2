<?php

include '../tools/common.php';

assert_session();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include '../site_scripts/db.php';

    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        // Extract from post and trim
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        // Check password
        $password_strength = check_password_strength($password);

        if ($password_strength !== "STRONG") {
            add_flash_message($password_strength);
            reload();
        }

        // Get id's where username matches what user entered
        $stmt = $mysqli->prepare('SELECT id FROM users WHERE username = ? LIMIT 1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        // Check if any matched
        if ($stmt->num_rows > 0) {
            $stmt->close();
            add_flash_message("Username already taken");
            reload();

        }
        $stmt->close();

        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Create new user
        $stmt = $mysqli->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)');
        $stmt->bind_param('ss', $username, $password_hash);

        if ($stmt->execute()) {

            // Set user data
            $user_id = $mysqli->insert_id;
            session_regenerate_id(true);
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            // Close database connection and send user to home page
            $stmt->close();
            $mysqli->close();
            header('Location: home.php');
            exit;

        } else {
            // If new user could not be created
            $stmt->close();
            add_flash_message("Something went wrong, please try again");
            reload();
        }



    } else/*if ($_SERVER['REQUEST_METHOD'] === 'POST')*/ {
        // If the user submitted the form but no fields were filled out
        add_flash_message("Please fill out all fields");
        reload();
    }
}

include_header();

include_once '../tools/flash.php';

?>



<div class="login-signup-card">
    <h2>Signup</h2>
    <form method="post">
        <label>Username<input name="username" type="text" placeholder="Username"></label>
        <label>Password<input name="password" type="password" placeholder="******"></label>
        <button name="submit" type="submit">Create account</button>
    </form>
    <h4>Already have an account? Login <a href="login.php">here</a></h4>
</div>

<?php
include '../components/footer.php'
    ?>