<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function hakiki($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data =  htmlspecialchars($data);
        return $data;
    }

    $jina = hakiki($_POST['name']);
    $pepe = hakiki($_POST['email']);
    $namba = hakiki($_POST['number']);
    $msimbo = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    if (strpos($namba, '0') === 0) {
        $namba = trim($namba, 0);
    }

    $emailc = mysqli_query($unga, "SELECT * FROM users WHERE pepe = '$pepe' ");

    if ($emailc->num_rows === 1) {
        $error = "<div class='error'>- This email is taken</div>";
        return $error;
    }

    $numberc = mysqli_query($unga, "SELECT * FROM users WHERE namba ='$namba' ");

    if ($numberc->num_rows === 1) {
        $error = "<div class='error'>- This number is taken</div>";
        return $error;
    }

    $kagua = mysqli_query($unga, "SELECT * FROM users WHERE jina ='$jina'");

    if ($kagua->num_rows === 1) {
        $error = "<div class='error'>- name ". $jina ." is already taken.</div>";
    } else {
        $hifadhi = mysqli_query($unga, "INSERT INTO `users` (`jina`, `pepe`, `namba`, `msimbo`, `jbiashara`, `aina`, `nida`) VALUE ('$jina', '$pepe', '$namba', '$msimbo', 'null', 'null', 'null')");

        if ($hifadhi) {
            header("location: login.php");
            exit;
        } else {
            $error = "<div class='error'> - Sorry there is an error, Try again.</div>";
        }
    }
}
?>