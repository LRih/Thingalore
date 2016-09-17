<?php

class Product
{
    public $id;
    public $name;
    public $desc;
    public $price;
    public $image;

    function __construct($id, $name, $desc, $price, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->price = $price;
        $this->image = $image;
    }

    function priceStr()
    {
        return number_format($this->price / 100, 2, '.', ',');
    }
}

?>