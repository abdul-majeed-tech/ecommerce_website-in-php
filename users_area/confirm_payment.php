<?php
include('../includes/connect.php');
session_start();

require_once __DIR__ . '/vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51T29caJAb3R3ZttKA8J0Pq8W0nk9HccqhaktSO6vJ8H1KOj4Q25vCtDMet3dyAGrtAHZcD8dgfftY75oFXhXTVdo00yEwek5BT');

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
}

$select_data = "SELECT * FROM user_orders WHERE order_id=$order_id";
$result = mysqli_query($con, $select_data);
$row_fetch = mysqli_fetch_assoc($result);

$invoice_number = $row_fetch['invoice_number'];
$amount_due     = $row_fetch['amount_due'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $invoice_number = $_POST['invoice_number'];
    $amount         = $_POST['amount'];
    $payment_mode   = $_POST['payment_mode'];

    if($payment_mode === 'Card'){
        if(empty($_POST['stripeToken'])){
            die('Stripe token missing. Please try again.');
        }

        try {
            $token = $_POST['stripeToken'];
            \Stripe\Charge::create([
                'amount'      => $amount * 100,
                'currency'    => 'pkr',
                'source'      => $token,
                'description' => 'Order Payment for Invoice: ' . $invoice_number
            ]);
        } 
        catch(Exception $e) {
            die('Stripe Error: ' . $e->getMessage());
        }
    }

   
    $insert_payment = "INSERT INTO `user_payment` (order_id, invoice_number, amount, payment_mode) 
                       VALUES ($order_id, $invoice_number, $amount, '$payment_mode')";
    mysqli_query($con, $insert_payment);

    $update_orders = "UPDATE `user_orders` SET order_status='complete' WHERE order_id=$order_id";
    mysqli_query($con, $update_orders);

    echo "<script>alert('Payment Successful'); window.location.href='profile.php?my_orders';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body class="bg-secondary">
    <div class="container my-5">
        <h2 class="text-center text-light">Confirm Payment</h2>
        <form method="post" id="payment-form">
            <div class="my-3 w-50 m-auto">
                <input type="text" class="form-control" name="invoice_number" value="<?php echo $invoice_number ?>" readonly>
            </div>
            <div class="my-3 w-50 m-auto">
                <input type="text" class="form-control" name="amount" value="<?php echo $amount_due ?>" readonly>
            </div>
            <div class="my-3 w-50 m-auto">
                <select name="payment_mode" class="form-select" id="payment_mode" required>
                    <option value="">Select payment mode</option>
                    <option value="Card">Card</option>
                    <option value="Cash on delivery">Cash on delivery</option>
                </select>
            </div>

            <div id="card-section" class="my-3 w-50 m-auto" style="display:none;">
                <label class="text-light">Card Details</label>
                <div id="card-element" class="form-control"></div>
                <div id="card-errors" class="text-danger mt-2"></div>
            </div>

            <div class="my-4 text-center">
                <button type="submit" id="submit-button" class="btn btn-info px-4">Confirm Payment</button>
            </div>
        </form>
    </div>

<script>
const stripe = Stripe('pk_test_51T29caJAb3R3ZttKMrcAgnSz9aEBEbi1xhb21PySOC70BWFj4SIpnWayNkbOp926L0KsWSQG6XRS3r8vOxeSvEcg00QnCeRC99');
const elements = stripe.elements();
const card = elements.create('card', { hidePostalCode: true });
card.mount('#card-element');

const form = document.getElementById('payment-form');
const paymentMode = document.getElementById('payment_mode');
const cardSection = document.getElementById('card-section');

paymentMode.addEventListener('change', () => {
    cardSection.style.display = paymentMode.value === 'Card' ? 'block' : 'none';
});

form.addEventListener('submit', async (e) => {
    if(paymentMode.value === 'Card'){
        e.preventDefault(); 
        
        const btn = document.getElementById('submit-button');
        btn.disabled = true;
        btn.innerText = "Processing...";

        const {token, error} = await stripe.createToken(card);

        if(error){
            document.getElementById('card-errors').innerText = error.message;
            btn.disabled = false;
            btn.innerText = "Confirm Payment";
            return;
        }

        
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        form.submit(); 
    }
});
</script>
</body>
</html>