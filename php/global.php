<?php
    require_once(dirname(__FILE__)."/sql.php");
    require_once(dirname(__FILE__)."/product.php");
    require_once(dirname(__FILE__)."/order.php");
    require_once(dirname(__FILE__)."/cart-item.php");
    require_once(dirname(__FILE__)."/cart.php");

    // pre-defined constants
    $TITLE = "Thingalore";

    $GLOBALS["test_mode"] = true;


    // only show errors when testing
    if ($GLOBALS["test_mode"])
        error_reporting(E_ALL);
    else
        error_reporting(0);
    
    // so we can make use of session state
    session_start();


    /**
     * Convenience function for setting redirect.
     */
    function redirect($location)
    {
        header("Location: ".$location);
        die;
    }
?>
