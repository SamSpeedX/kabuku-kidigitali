<?php

function bussness($jina, $pepe, $namba, $msimbo, $jbiashara, $aina, $nida, $unga) {
    $jina;
}

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
    $aina = hakiki($_POST['type']);
    $nida = hakiki($_POST['nida']);
    
    if (strpos($namba, '0') === 0) {
        $namba = trim($namba, 0);
    }

    bussness($jina, $pepe, $namba, $msimbo, $jbiashara, $aina, $nida, $unga);
}
?>