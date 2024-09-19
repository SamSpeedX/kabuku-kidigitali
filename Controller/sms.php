<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php'; // Load Composer's autoloader

use Twilio\Rest\Client;

// Twilio credentials
$account_sid = ''; 
$auth_token = ''; 
$twilio_phone_number = ''; 

$client = new Client($account_sid, $auth_token);

function send_sms($to, $message) {
    global $client, $twilio_phone_number;

    try {
        $message = $client->messages->create(
            $to, 
            [
                'from' => $twilio_phone_number, // Twilio phone number
                'body' => $message,
            ]
        );
        return 'Message sent with SID: ' . $message->sid;
    } catch (Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
}

$to = 255778760701;
$message = "api text by sam ochu";
send_sms($to, $message)

// Handling the POST request
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Get POST body content
//     $input = json_decode(file_get_contents('php://input'), true);
//     $to = $input['to'];
//     $message = $input['message'];

//     // Send the SMS
//     $response = send_sms($to, $message);

//     // Return JSON response
//     header('Content-Type: application/json');
//     echo json_encode(['message' => $response]);
// }
?>
