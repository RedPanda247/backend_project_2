<?php
function assert_session()
{
    if (!isset($_SESSION)) {
        session_start();
    }
}

function local_api_fetch($api)
{
    // Start output buffering
    ob_start();

    // Run api php file
    include $api;
    
    // Get its output
    $output = ob_get_clean();

    // Decode json
    $response = json_decode($output, true);

    return $response;
}
