<?php
// require '../config/app.php';

// session_start();

$uid = $_SESSION['uid'];

$stmt = $unga->prepare("SELECT * FROM `users` WHERE id = ?");
$stmt->bind_param('i', $uid);
$stmt->execute();
$kweli = $stmt->get_result();

if ($kweli) {
    $mtu = mysqli_fetch_assoc($kweli);
    $jina = $mtu['jina'];
    $pepe = $mtu['pepe'];
    $namba = $mtu['namba'];

}
?>