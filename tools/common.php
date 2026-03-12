<?php
function assert_session()
{
    if (session_status() === PHP_SESSION_NONE) {
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

function include_header()
{
    include '../components/header.php';
}

function include_flash_message()
{
    include 'flash.php';
}

function add_flash_message($message)
{
    $_SESSION["flash_messages"][] = $message;
}

function reload()
{
    $current_page = basename($_SERVER['PHP_SELF']);
    header("Location: $current_page");
    exit;
}
