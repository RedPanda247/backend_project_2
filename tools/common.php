<?php
function assert_session() {
    if (!isset($_SESSION)) {
        session_start();
    }
}
?>