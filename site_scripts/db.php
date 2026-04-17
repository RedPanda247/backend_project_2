<?php
// Database settings
$db = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'backend_project_2',
];

$mysqli = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);

if ($mysqli->connect_errno) {
    http_response_code(500);
    echo 'An error occurred';
    exit;
}
?>