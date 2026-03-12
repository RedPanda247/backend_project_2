<?php

include '../tools/common.php';

include_header();

if (isset($_GET['username'], $_GET['password'])) {
    
}

?>



<div class="login-signup-card">
    <form method="post">
        <label>Username<input name="username" type="text" placeholder="Username"></label>
        <label>Password<input name="password" type="password" placeholder="******"></label>
    </form>
</div>

<?php
include '../components/footer.php'
    ?>