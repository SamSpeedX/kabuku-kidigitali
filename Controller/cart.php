<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './config/database.php';
$bid = 3;
$stmt = $kibalanga->prepare("SELECT * FROM `products` WHERE seller_id = ? ");
$stmt->bind_param('i', $bid);
$stmt->execute();
$jibu = $stmt->get_result();

if ($jibu) {
    $data = mysqli_fetch_assoc($jibu);

    if ($data) {
        $data;
    }

} else {
    $error = "Cart is Empty";
}

mysqli_close($kibalanga);
?>