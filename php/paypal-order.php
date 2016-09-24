<?php

/**
 * Details relating to a PayPal order.
 */
class PayPalOrder
{
    public $orderId;
    public $token; // token provided by paypal linked to order

    function __construct($orderId, $token)
    {
        $this->orderId = $orderId;
        $this->token = $token;
    }
}

?>