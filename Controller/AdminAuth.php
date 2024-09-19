<?php
$stmt = $kibalanga->prepare("SELECT * FROM `users` WHERE id = ? ");
$stmt->bind_param('i', $uid);
$stmt->execute();
$ress = $stmt->get_result();

if ($ress->num_rows === 1) {
    $usersss = mysqli_fetch_assoc($ress);
    $seller = $usersss['account'];
}

if ($seller == 'client') {
    header("location: profile.php");
    exit;
}
?>