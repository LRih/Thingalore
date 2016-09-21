<?php

require_once("../php/global.php");

$price = number_format($_SESSION["cart"]->price() / 100, 2, '.', '');

$host = $GLOBALS["test_mode"] ? "http://localhost" : $GLOBALS["paypal_host"];

$nvp = array(
    'USER' => $GLOBALS["paypal_user"],
    'PWD' => $GLOBALS["paypal_pwd"],
    'SIGNATURE' => $GLOBALS["paypal_signature"],
    'VERSION' => '98',
    'METHOD' => 'SetExpressCheckout',

    'RETURNURL' => "{$host}/checkout-review.php",
    'CANCELURL' => "{$host}/checkout.php",

    'PAYMENTREQUEST_0_AMT' => $price,
    'PAYMENTREQUEST_0_CURRENCYCODE' => "AUD",
    
    "L_PAYMENTREQUEST_0_NAME0" => "Order",
    "L_PAYMENTREQUEST_0_AMT0" => $price,
    "L_PAYMENTREQUEST_0_CURRENCYCODE0" => "AUD"
);

$request = 'https://api-3t.sandbox.paypal.com/nvp?'.http_build_query($nvp);

// submit request for paypal token
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $request);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($curl);

curl_close($curl);

// parse token and return
$token = parseNVP($response)["TOKEN"];
$_SESSION["paypal_token"] = $token;

// TODO detect when fail

echo $token;


function parseNVP($nvp)
{
    $result = array();
    parse_str($nvp, $result);
    return $result;
}

?>