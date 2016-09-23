<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

// TODO replace with proper login
$_SESSION["user"] = SQL::getCustomer(1);

redirect("../index.php");

?>