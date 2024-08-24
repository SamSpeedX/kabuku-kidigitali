<?php
// feel freee to contribute on this project 
function login($jina, $msimbo, $unga) {
    $stmt = $unga->prepare("SELECT * FROM `users` WHERE pepe = ? OR namba = ? ");
    $stmt->bind_param('si', $jina, $jina);
    $stmt->execute();
    $majibu = $stmt->get_result();

    if ($majibu->num_rows === 1) {
        $mtu = mysqli_fetch_assoc($majibu);

        if ($mtu) {
            if (password_verify($msimbo, $mtu['msimbo'])) {
                session_start();
                $_SESSION['uid'] = $mtu['id'];
                header("location: home.php");
                exit;
            } else {
                $error = "Incorrect password!";
                return $error;
            }
        } else {
            $error = "Fail to verify your data";
            return $error;
        }
    } else {
        $error = "Incorrect Email or Phone number";
        return $error;
    }
}

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

    login($jina, $msimbo, $unga);
}
?>