<?php
    session_start();
    if($_SESSION['users']) {
        header('Location: homepage.php');
    } else {
        header('Location: login.php');
    }
?>
