<?php

require __DIR__ . '/vendor/autoload.php'; // Composer autoload

use Dotenv\Dotenv;

// Load the .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('APP_NAME', $_ENV['APP_NAME']);
define('ZENOPAY_SECRET_KEY', $ENV['ZENOPAY_SECRET_KEY']);
define('DB_HOST',  $_ENV['DB_HOST']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASS', $_ENV['DB_PASS']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_NAME', $_ENV['DB_PORT']);

$unga = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

if ($unga->connect_error) {
    die("connection fail:" . $unga->connect_error);
}
?>
