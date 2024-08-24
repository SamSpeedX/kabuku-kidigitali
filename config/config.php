<?php
define('APP_NAME', 'KAUKU KIDIGITAL');
define('ZENOPAY_SECRET_KEY', '');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kabuku');

$unga = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($unga->connect_error) {
    die("connection fail:" . $unga->connect_error);
}
?>
