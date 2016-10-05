<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

// required variables not set
if (!isset($_GET["email"]))
    die;

$email = htmlentities(trim($_GET["email"]));

if (SQL::isEmailExist($email))
    echo "Exists";

?>