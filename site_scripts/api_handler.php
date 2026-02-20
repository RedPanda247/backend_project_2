<?php

$refresh_api_key = "My_Awesome_Key_88488";

function get_api_data()
{
    $api_key = 'ee824f8d018d462599c6a141417eeefc';
    $api_url = 'https://api.rawg.io/api/games';

    $request = $api_url . "?key=" . $api_key;

    $response = file_get_contents($request);

    if ($response  === FALSE) {
        return null;
    } else {
        return $response;
    }
}

function refresh_api_data()
{
    $data = get_api_data();
    if ($data !== null) {
        file_put_contents("../data/games_data.json", $data);
        return true;
    } else {
        return false;
    }
}
