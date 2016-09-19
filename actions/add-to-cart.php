<?php

require_once("../php/global.php");

// only allow post
if ($_SERVER["REQUEST_METHOD"] !== "POST")
    redirect("../cart.php");

$p = SQL::getProduct($_POST["id"]);

// invalid product id
if (is_null($p))
    redirect("../cart.php");

// create cart object if required
if (!isset($_SESSION["cart"]))
    $_SESSION["cart"] = new Cart();

// add product to cart
$_SESSION["cart"]->add($p);

// redirect to cart
redirect("../cart.php");

?>