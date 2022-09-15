<?php
require_once(__DIR__.'/../../vendor/autoload.php');

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey('sk_test_51LCKVvL19W3GP67G18FvUP1QbK15bWkhQgzMSKzF92xPCeMJrxTxhsBsdOdt2YjqYbAJ0is84F6kxKY0Pa8GhYSO00rJefRPOY');


// The price ID passed from the front end.
$priceId = $_POST['priceId'];

$session = \Stripe\Checkout\Session::create([
  'line_items' => [[
      'price' => $priceId,
      'quantity' => 1,
    ]],
    'mode' => 'subscription',
    'success_url' => 'http://localhost:8080/upwork/stripe_success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'http://localhost:8080/upwork/stripe_canceled.php',
  ]);

// Redirect to the URL returned on the Checkout Session.
// With vanilla PHP, you can redirect with:
header("HTTP/1.1 303 See Other");
header("Location: " . $session->url);

?>