<?php

class OrderItem
{
    public $product;
    public $qty;
    public $price;

    function __construct($product, $qty, $price)
    {
        $this->product = $product;
        $this->qty = $qty;
        $this->price = $price;
    }

    function formattedPrice()
    {
        return "$ ".number_format($this->price / 100, 2, '.', ',');
    }
}

?>