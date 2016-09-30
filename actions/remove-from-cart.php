<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

if (!isset($_SESSION["cart"]) || !isset($_GET["id"]))
    redirect("../cart.php");

// remove product to cart
$_SESSION["cart"]->remove($_GET["id"]);

// redirect to cart
redirect("../cart.php");

?>