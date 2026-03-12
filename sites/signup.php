<?php

include '../tools/common.php';

include_header();

if (isset($_POST)) {
    include '../site_scripts/db.php';
}

if (isset($_POST['username'], $_POST['password'])) {
    // Get all usenames from database
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $stmt = $mysqli->prepare('SELECT id FROM users WHERE username = ? LIMIT 1');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

    }
    echo $username;
    // header("Location: #");
    // $stmt = $mysqli->prepare($sql);
}

include '';

?>



<div class="login-signup-card">
    <h2>Signup</h2>
    <form method="post">
        <label>Username<input name="username" type="text" placeholder="Username"></label>
        <label>Password<input name="password" type="password" placeholder="******"></label>
        <button type="submit">Create account</button>
    </form>
</div>

<?php
include '../components/footer.php'
    ?>