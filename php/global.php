<?php
    require_once(dirname(__FILE__)."/sql.php");
    require_once(dirname(__FILE__)."/customer.php");
    require_once(dirname(__FILE__)."/product.php");
    require_once(dirname(__FILE__)."/order.php");
    require_once(dirname(__FILE__)."/cart-item.php");
    require_once(dirname(__FILE__)."/cart.php");
    require_once(dirname(__FILE__)."/paypal.php");


    // ======================================================================== pre-defined constants

    $TITLE = "Thingalore";

    $GLOBALS["test_mode"] = true;
    
    $GLOBALS["paypal_user"] = "richard1421-facilitator_api1.msn.com";
    $GLOBALS["paypal_pwd"] = "39BP2SU6ASXTK95N";
    $GLOBALS["paypal_signature"] = "AFcWxV21C7fd0v3bYYYRCpSSRl31Av6s9SFPSURsdjinrZcZARkajtEU";
    
    $GLOBALS["paypal_host"] = "http://localhost";
    // $GLOBALS["paypal_host"] = "http://sec1.onevis.net";
    // $GLOBALS["paypal_host"] = "https://onevis.net/sub/sec1";

    // ========================================================================


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
