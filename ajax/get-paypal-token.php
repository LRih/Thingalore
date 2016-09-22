<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

$price = number_format($_SESSION["cart"]->price() / 100, 2, '.', '');

$response = PayPal::setExpressCheckout($price);

// error if TOKEN does not exist
if (array_key_exists("TOKEN", $response))
{
    $token = $response["TOKEN"];

    // remember token for checking later
    $_SESSION["paypal_token"] = $token;

    echo $token;
}
else
    echo "Failure";

?>