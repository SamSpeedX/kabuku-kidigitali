<?php
require_once 'unga.php';




$uid = $_SESSION['uid'];

$kweli = mysqli_query($unga, "SELECT * FROM `users` WHERE id = '$uid'");

if ($kweli->num_rows === 1) {
    $mtu = mysqli_fetch_assoc($kweli);
    $jina = $mtu['jina'];
    $pepe = $mtu['pepe'];
    $namba = $mtu['namba'];

}

mysqli_close($unga);
?>