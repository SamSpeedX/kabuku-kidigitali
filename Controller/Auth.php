<?php 
session_start();

if (!isset($_SESSION['uid'])) {
    header("location: signin.php");
    exit;
} else {
    $uid = $_SESSION['uid'];
}
?>