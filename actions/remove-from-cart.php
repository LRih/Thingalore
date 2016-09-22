<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

if (!isset($_SESSION["cart"]) || !isset($_GET["id"]))
    redirect("../cart.php");

// remove any paypal token (prevents user from modifying cart after going through PayPal)
unset($_SESSION["paypal_token"]);

// add product to cart
$_SESSION["cart"]->remove($_GET["id"]);

// redirect to cart
redirect("../cart.php");

?>