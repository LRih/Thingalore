<?php

require_once("../php/global.php");

// valid token is required
if (!isset($_GET["token"]))
    die;

$nvp = array(
    'USER' => $GLOBALS["paypal_user"],
    'PWD' => $GLOBALS["paypal_pwd"],
    'SIGNATURE' => $GLOBALS["paypal_signature"],
    'VERSION' => '98',
    'METHOD' => 'GetExpressCheckoutDetails',

    'TOKEN' => $_GET["token"]
);

$request = 'https://api-3t.sandbox.paypal.com/nvp?'.http_build_query($nvp);

// submit request for paypal order details
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $request);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($curl);

curl_close($curl);

// TODO detect when fail

// return order details
echo $response;


function parseNVP($nvp)
{
    $result = array();
    parse_str($nvp, $result);
    return $result;
}

?>