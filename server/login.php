<?php
require_once 'unga.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function hakiki($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data =  htmlspecialchars($data);
        return $data;
    }

    $jina = hakiki($_POST['pass']);
    $msimbo = $_POST['password'];

    if (strpos($jina, '0') === 0) {
        $jina = trim($jina, 0);
    }

    $kagua = mysqli_query($unga, "SELECT * FROM `users` WHERE pepe = '$jina' OR namba = '$jina'");

    if ($kagua->num_rows === 1) {
        $mt = mysqli_fetch_assoc($kagua);
        
        if (password_verify($msimbo, $mt['msimbo'])) {
            session_start();
            if ($mt['aina'] === "null") {
                $_SESSION['aina'] = "";
            } else {
                $_SESSION['aina'] = "bussness";
            }
            $_SESSION['uid'] = $mt['id'];
            header("location: home.php");
            exit;
        } else {
            $error = "<div class='error'>- Incorrect password.</div>";
        }

    } else {
        $error = "<div class='error'>- No such Email or Nember</div>";
    }
}
?>