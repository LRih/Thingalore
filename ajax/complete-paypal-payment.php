<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

// required variables not set
if (!isset($_SESSION["paypal_order"]))
    die;

$paymentSuccessful = tryCompletePayment();

if (!$paymentSuccessful)
    die;

// update order in DB to processing
SQL::updateOrder($_SESSION["paypal_order"]->orderId, "Processing");

// flag order complete
$_SESSION['checkout_complete_id'] = $_SESSION["paypal_order"]->orderId;

// empty cart and remove in-progress order
unset($_SESSION["paypal_order"]);
$_SESSION["cart"]->clear();

echo "Success";



function tryCompletePayment()
{
    // submit request for paypal order details
    $response = PayPal::getExpressCheckoutDetails($_SESSION["paypal_order"]->token);

    // FAILED get details
    if ($response["ACK"] != "Success")
        return false;

    // send final payment request
    $response = PayPal::doExpressCheckoutPayment($response["TOKEN"], $response["PAYERID"], $response["AMT"]);

    // FAILED payment
    if ($response["ACK"] != "Success")
        return false;

    return true;
}

?>