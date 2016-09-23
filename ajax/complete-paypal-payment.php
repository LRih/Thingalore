<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

if (!isset($_GET["token"]))
    die;

// submit request for paypal order details
$response = PayPal::getExpressCheckoutDetails($_GET["token"]);

// FAILED get details
if ($response["ACK"] != "Success")
    die;

// cart modified, terminate
if (!isset($_SESSION["paypal_token"]) || $_SESSION["paypal_token"] != $_GET["token"])
    die;

// add order to DB as unpaid
$orderId = SQL::insertOrder($_SESSION["user"], $_SESSION["cart"], "Unpaid");

// FAILED insertion
if ($orderId == -1)
    die;

// send final payment request
$response = PayPal::doExpressCheckoutPayment($response["TOKEN"], $response["PAYERID"], $response["AMT"]);

// FAILED payment
if ($response["ACK"] != "Success")
{
    // TODO remove order from SQL database
    die;
}

// update order in DB to processing
SQL::updateOrder($orderId, "Processing");

// empty cart
$_SESSION["cart"]->clear();

// flag order complete
$_SESSION['checkout_complete_id'] = $orderId;
echo "Success";

?>