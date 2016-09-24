<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

if (!isset($_SESSION["cart"]) || !isset($_GET["id"]))
    redirect("../cart.php");

// add product to cart
$_SESSION["cart"]->removeAll($_GET["id"]);

// redirect to cart
redirect("../cart.php");

?>