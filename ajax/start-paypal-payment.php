<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

// add order to DB as incomplete
$orderId = SQL::insertOrder($_SESSION["user"], $_SESSION["cart"], "Incomplete");

// FAILED insertion
if ($orderId == -1)
{
    echo "Failure";
    die;
}

// request for paypal token
$price = number_format($_SESSION["cart"]->price() / 100, 2, '.', '');
$response = PayPal::setExpressCheckout($orderId, $price);

// error if TOKEN does not exist
if (!array_key_exists("TOKEN", $response))
{
    echo "Failure";
    die;
}

$token = $response["TOKEN"];

// remember order details for checking later
$_SESSION["paypal_order"] = new PayPalOrder($orderId, $token);

echo $token;

?>