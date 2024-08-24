<?php
require_once './config/zeno.php';
require_once 'config/config.php';
require_once 'ZenoPay.php';

use ZenoPay\ZenoPay;

function pay($account_id, $api_key, $secret_key, $api_endpoint, $buyer_id, $seller_id, $product, $buyer_email, $buyer_name, $buyer_phone, $amount, $order, $unga) {
    $zenoPay = new ZenoPay($account_id, $api_key, $secret_key, $api_endpoint);

    
    $response = $zenoPay->processPayment($order, $buyer_email, $buyer_name, $buyer_phone, $amount);
    
    if ($response['result'] == 'success') {
        $stmt = $unga->prepare("INSERT INTO `payments` (buyer_id, seller_id, product) VALUE (?, ?, ?)");
        $stmt->bind_param('iii', $buyer_id, $seller_id, $product);
        $stmt->execute();
        $imelipwa = $stmt->get_result();

        if ($imelipwa) {
            $lipa = $unga->prepare("UPDATE INTO `carts` SET 'status' = ? ");
            $lipa->bind_param('s', "paid");
            $lipa->execute();
    
        }

        header('Location: ' . $response['redirect']);
        exit;
    } else {
        $error = 'Payment failed: ' . $response['error'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    function hakikisha($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }

    $order = hakikisha($_POST['order']);
    $seller_id = hakikisha($_POST['muuza']);
    $buyer_id = hakikisha($_POST['mnunua']);
    $product = hakikisha($_POST['bidhaa']);
    $bai = hakikisha($_POST['bai']);
    $create_order = hakikisha($_POST['order']);
    $buyer_email = hakikisha($_POST['email']);
    $buyer_name = hakikisha($_POST['name']);
    $buyer_phone = hakikisha($_POST['namba']);
    $amount = hakikisha($_POST['kiasi']);

    pay($account_id, $api_key, $secret_key, $api_endpoint, $buyer_id, $seller_id, $product, $buyer_email, $buyer_name, $buyer_phone, $amount, $order, $unga);
}
?>
