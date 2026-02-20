<?php
// USE SNAKE CASE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
include_once '../tools/common.php';

assert_session();


?>

<button id="refresh-btn">
    Refresh api
</button>

<h2 id="refresh-result">
    Result
</h2>

<script>
    document.getElementById('refresh-btn').addEventListener('click', (event) => {
        event.preventDefault();
        fetch('../site_scripts/refresh_api.php?key=My_Awesome_Key_88488')
            .then(response => response.text())
            .then(data => {
                document.getElementById('refresh-result').textContent = data;
            })
            .catch(error => {
                document.getElementById('refresh-result').textContent = 'Error refreshing API.';
            });
    });
</script>