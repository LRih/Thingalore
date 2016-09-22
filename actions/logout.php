<?php

require_once(dirname(dirname(__FILE__))."/php/global.php");

unset($_SESSION["user"]);

redirect("../index.php");

?>