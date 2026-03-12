<?php

include '../tools/common.php';

include_header();

if (isset($_GET)) {
    include '../site_scripts/db.php';
}

if (isset($_GET['username'], $_GET['password'])) {
    // Get all usenames from database
    $username = $_GET['username'];
    $password = $_GET['password'];

}

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