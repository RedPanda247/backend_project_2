<?php
include 'api_handler.php';

// file_put_contents("../data/games_data.json", get_api_data());


// Skip key validation for internal calls (when included via local_api_fetch)
if (isset($_GET["key"]) || $_GET["key"] !== $refresh_api_key) {
    echo json_encode(['status' => 'unauthorized']);
} else {
    if (refresh_api_data()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'fail']);
    }
}



// Always return sucess for now in development
// echo json_encode(['status' => 'success']);

?>