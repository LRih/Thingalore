<?php

class CartItem
{
    public $product;
    public $qty = 0;

    function __construct($product)
    {
        $this->product = $product;
    }

    function price()
    {
        return $this->product->price * $this->qty;
    }

    function formattedPrice()
    {
        return number_format($this->price() / 100, 2, '.', ',');
    }
}

?>