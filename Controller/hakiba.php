<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './config/database.php';

header("Content-Type: application/json");

$header = function_exists('getallheaders') ? getallheaders() : [];
$api = isset($header['API']) ? $header['API'] : '';
$token = isset($header['Token']) ? $header['Token'] : '';

if ($_GET['action'] === 'getcart') {
$uid = 3;
    if ($api == 'sam' && $token == 'ochu') {
        $stmt = $kibalanga->prepare("SELECT * FROM `products` WHERE id = ? ");
        $stmt->bind_param('i', $bid);
        $stmt->execute();
        $jibu = $stmt->get_result();
    
        if ($jibu->num_rows === 1) {
            $dat = mysqli_fetch_assoc($jibu);
            // $data = [
            //     'product' => $dat['pro_name'],
            //     'pic' => $dat['pro_pic'],
            //     'price' => $dat['pro_price'],
            // ];
            // json_decode($data);
        } else {
        header('HTTP/1.0 403 Forbidden');
        echo json_encode(['status' => 'error', 'message' => 'Invalid API Key or Token']);
        exit();
        }
        echo json_encode($data);
    } else {
        header('HTTP/1.0 404 Not Found');
        echo json_encode(['status' => 'error', 'message' => 'Invalid API request']);
    }

}
mysqli_close($kibalanga);
?>