<?php
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
?>
