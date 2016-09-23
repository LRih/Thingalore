<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

// required variables not set
if (!isset($_GET["token"]) || !isset($_SESSION["paypal_token"]))
    die;

// unmatching token means cart modified, terminate
if ($_SESSION["paypal_token"] != $_GET["token"])
    die;

// add order to DB as unpaid
$orderId = SQL::insertOrder($_SESSION["user"], $_SESSION["cart"], "Unpaid");

// FAILED insertion
if ($orderId == -1)
    die;

$paymentSuccessful = tryCompletePayment();

if ($paymentSuccessful)
{
    // update order in DB to processing
    SQL::updateOrder($orderId, "Processing");

    // empty cart
    $_SESSION["cart"]->clear();

    // flag order complete
    $_SESSION['checkout_complete_id'] = $orderId;
    echo "Success";
}
else
{
    // TODO remove order from SQL database
}



function tryCompletePayment()
{
    // submit request for paypal order details
    $response = PayPal::getExpressCheckoutDetails($_GET["token"]);

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