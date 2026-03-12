<?php
include '../tools/common.php';

assert_session();

include_header();

?>



<h1><?php echo "Hello: " . htmlspecialchars($_SESSION['username']); ?></h1>

<a href="../site_scripts/logout.php">Logout</a>



<?php include_footer(); ?>