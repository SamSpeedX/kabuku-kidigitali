<?php
define('APP_NAME', 'KAUKU KIDIGITAL');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kabuku');

$unga = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$unga) {
    die("connection fail:" . mysqli_connect_error());
}
// echo "sam";
?>
