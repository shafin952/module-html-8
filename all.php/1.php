<?php
    session_start();
    if(!isset($_SESSION["fname"])) {
        header("Location: login.php");
        exit();
    }
?>