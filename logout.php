<?php 
    session_start();
    if (isset($_SESSION['username'])) {
        session_destroy();
    }
    header("Location: hw1.php");
    exit();
?>