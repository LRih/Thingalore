<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

$price = number_format($_SESSION["cart"]->price() / 100, 2, '.', '');

$response = PayPal::set_express_checkout($price);

// error if TOKEN does not exist
if (array_key_exists("TOKEN", $response))
{
    $token = PayPal::set_express_checkout($price)["TOKEN"];

    // remember token for checking later
    $_SESSION["paypal_token"] = $token;

    echo $token;
}


?>