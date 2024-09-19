<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kabuku');

$kibalanga = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$kibalanga) {
    die('Hakuna ufikivu wa Kitunza kumbukumbu <br>' . mysqli_connect_error());
}