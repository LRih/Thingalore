<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

$p = SQL::getProduct($_GET["id"]);

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