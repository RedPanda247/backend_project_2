<?php
include '../tools/common.php';

assert_session();

include_header();

if (!$_SESSION['logged_id']) {
    add_flash_message('You must be logged in to see the profile page');
    header('Location: home.php');
    exit;
}

?>



<h1><?php echo "Hello: " . htmlspecialchars($_SESSION['username']); ?></h1>

<a href="../site_scripts/logout.php">Logout</a>



<?php include_footer(); ?>