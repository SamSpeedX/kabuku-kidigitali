<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config/database.php';

function ulinzi($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jina = ulinzi($_POST['username']);
    $ukoo = ulinzi($_POST['ukoo']);
    $pepe = ulinzi($_POST['email']);
    $namba = ulinzi($_POST['number']);
    $makazi = ulinzi($_POST['address']);
    $msimbo = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $jbiashara = ulinzi('hakuna');
    $aina = ulinzi('hakuna');
    $nida = ulinzi('hakuna');
    $account = ulinzi('client');
    $muda = date('H:i:s Y-m-d');

    $name = $kibalanga->prepare("SELECT * FROM `users` WHERE jina = ? ");
    $name->bind_param('s', $jina);
    $name->execute();
    $j_m = $name->get_result();

    if ($j_m->num_rows === 1) {
        header("location: ../client.php?status=Jina limekwisha kutumika");
        exit;
    }
    $name->close();

    $email = $kibalanga->prepare("SELECT * FROM `users` WHERE pepe = ? ");
    $email->bind_param('s', $pepe);
    $email->execute();
    $e_m = $email->get_result();

    if ($e_m->num_rows === 1) {
        header("location: ../client.php?status=Email imekwisha kutumika.");
        exit;
    }
    $email->close();

    $number = $kibalanga->prepare("SELECT * FROM `users` WHERE namba = ? ");
    $number->bind_param('i', $namba);
    $number->execute();
    $nu_m = $number->get_result();

    if ($nu_m->num_rows === 1) {
        header("location: ../client.php?status=Namba imekwisha kutumika");
        exit;
    }else {
        $stmt = $kibalanga->prepare("INSERT INTO `users` (jina, ukoo, pepe, namba, makazi, msimbo, jbiashara, aina, nida, account, muda) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
        $stmt->bind_param('sssissssssi', $jina, $ukoo, $pepe, $namba, $makazi, $msimbo, $jbiashara, $aina, $nida, $account, $muda);
    
        if ($stmt->execute()) {
            header("location: ../signin.php");
            exit;
        } else {
            header("location: ../client.php?status=Kuna tatizo Samahani rudia tena.");
            exit;
        }
    }
    $number->close();

}
mysqli_close($kibalanga);
?>