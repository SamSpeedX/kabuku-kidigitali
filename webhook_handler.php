<?php
require 'vendor/autoload.php';
require './config/config.php'; 

use GuzzleHttp\Client;

$client = new Client();

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_X_SIGNATURE'];

if (hash_equals(hash_hmac('sha256', $payload, ZENOPAY_SECRET_KEY), $sig_header)) {
    $event = json_decode($payload, true);

    switch ($event['type']) {
        case 'payment.succeeded':
            // Handle successful payment
            $payment = $event['data']['object'];
            handlePaymentSucceeded($payment);
            break;
        // Handle other event types...
        default:
            echo 'Received unknown event type ' . $event['type'];
    }

    http_response_code(200);
} else {
    // Invalid signature
    http_response_code(400);
    echo 'Invalid signature';
}

function handlePaymentSucceeded($payment) {
    // Handle successful payment logic here
}
?>