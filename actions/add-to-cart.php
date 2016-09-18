<?php

require_once("../php/global.php");

// only allow post
if ($_SERVER["REQUEST_METHOD"] !== "POST")
{
    header('Location: ../cart.php');
    die;
}

$p = SQL::getProduct($_POST["id"]);

// invalid product id
if (is_null($p))
{
    header('Location: ../cart.php');
    die;
}

// create cart object if required
if (!isset($_SESSION["cart"]))
    $_SESSION["cart"] = new Cart();

// add product to cart
$_SESSION["cart"]->add($p);

// redirect to cart
header('Location: ../cart.php');
die;

?>