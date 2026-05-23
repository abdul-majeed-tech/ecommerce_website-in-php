<?php
require 'vendor/autoload.php';

// Errors display karne ke liye
error_reporting(E_ALL);
ini_set('display_errors', 1);

\Stripe\Stripe::setApiKey('sk_test_51T29caJAb3R3ZttKA8J0Pq8W0nk9HccqhaktSO6vJ8H1KOj4Q25vCtDMet3dyAGrtAHZcD8dgfftY75oFXhXTVdo00yEwek5BT');

header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "mystore");

if ($conn->connect_error) {
    echo json_encode(['error' => 'DB Connection Error']);
    exit;
}

// Dynamic Order ID
$order_id = "ORD-" . time(); 
$amount = 20.00;

// Database mein insertion
$stmt = $conn->prepare("INSERT INTO orders (order_id, amount, status) VALUES (?, ?, 'pending')");
$stmt->bind_param("sd", $order_id, $amount);

if (!$stmt->execute()) {
    echo json_encode(['error' => 'Database Insert Failed: ' . $stmt->error]);
    exit;
}

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => 'Test Product'],
                'unit_amount' => 2000, 
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'metadata' => [
            'order_id' => $order_id 
        ],
        'success_url' => 'http://localhost/ecommerce_website/stripe_test/success.php',
        'cancel_url' => 'http://localhost/ecommerce_website/stripe_test/index.php',
    ]);

    echo json_encode(['id' => $session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>