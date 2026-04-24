<?php

include_once '../tools/common.php';

include_header();


if (isset($_GET["refresh_game_api_data"])) {
    // Refresh game api data with own api because it's cool
    $response = local_api_fetch("../site_scripts/refresh_api.php?key=My_Awesome_Key_88488");
    // Add the api response to flash messages
    $_SESSION["flash_messages"][] = "Refresh game api data: " . $response["status"];

    // Redirect to the same page to avoid resend form on reload 
    header("Location: admin.php");
    exit;
}

if (isset($_GET["json_api_data_to_database"])) {

    add_flash_message(json_api_data_to_database() ? "failed" : "Sucess");

    // reload();
}

include_once '../tools/flash.php';

?>

<form method="get">
    <input type="hidden" name="refresh_game_api_data">
    <button>
        Refresh api
    </button>
</form>

<form method="get">
    <input type="hidden" name="json_api_data_to_database">
    <button>
        Send data to database
    </button>
</form>

<?php
include_once '../components/footer.php';
?>