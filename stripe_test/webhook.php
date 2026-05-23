<?php
require 'vendor/autoload.php';


$endpoint_secret = 'whsec_000504a37a6c67f7a7397a0a8bfb1591efc4036ad7f00eebfd16d594fecb6284';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
} catch (\UnexpectedValueException $e) {
    http_response_code(400);
    exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    http_response_code(400);
    exit();
}


if ($event->type == 'checkout.session.completed') {
    $session = $event->data->object;
    $order_id = $session->metadata->order_id;

    
    $conn = new mysqli("localhost", "root", "", "mystore");
$conn->query("UPDATE orders SET status = 'paid' email = '$customer_email' WHERE order_id = '$order_id'");
}

http_response_code(200);
?>