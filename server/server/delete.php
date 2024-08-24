<?php
require_once 'unga.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete = $_POST['delete'];
    echo $delete;
}
?>