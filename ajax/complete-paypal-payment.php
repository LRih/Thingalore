<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

if (!isset($_GET["token"]))
    die;

// submit request for paypal order details
$response = PayPal::getExpressCheckoutDetails($_GET["token"]);

// failed request
if ($response["ACK"] != "Success")
    die;

// cart modified, terminate
if (!isset($_SESSION["paypal_token"]) || $_SESSION["paypal_token"] != $_GET["token"])
    die;

// TODO add to SQL database and empty cart

// send final payment request
$response = PayPal::doExpressCheckoutPayment($response["TOKEN"], $response["PAYERID"], $response["AMT"]);

// failed request
if ($response["ACK"] != "Success")
    die;

$_SESSION['allow_checkout_complete'] = true;
echo "Success";

?>