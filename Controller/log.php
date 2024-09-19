<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config/database.php';

function ingia($pass, $msimbo, $kibalanga) {
    $stmt = $kibalanga->prepare("SELECT * FROM `users` WHERE pepe = ? OR namba = ? ");
    $stmt->bind_param('si', $pass, $pass);
    $stmt->execute();
    $jibu = $stmt->get_result();

    if ($jibu->num_rows === 1) {
        $mtu = mysqli_fetch_assoc($jibu);

        if (password_verify($msimbo, $mtu['msimbo'])) {
            session_start();
            $_SESSION['uid'] = $mtu['id'];
            header("location: ../home.php");
            exit;
        } else {
            header("location: ../signin.php?status=Password sio sahihi \n invalid password");
            exit;
        }
    } else {
        header("location: ../signin.php?status=Email au namba sio sahihi");
        exit;
    }
}

function ulinzi($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pass = ulinzi($_POST['pass']);
    $msimbo = ulinzi($_POST['password']);

    ingia($pass, $msimbo, $kibalanga);
}
?>