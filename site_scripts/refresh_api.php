<?php
include 'api_handler.php';

// file_put_contents("../data/games_data.json", get_api_data());


if (isset($_GET["key"])) {
    if ($_GET["key"] === $refresh_api_key) {
        if (refresh_api_data()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'fail']);
        }
    }
}
