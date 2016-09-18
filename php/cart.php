<?php

class Cart
{
    private $productsIds = [];
    private $count = 0;

    function __construct()
    {
    }

    function add($productId)
    {
        // add product id if not yet added
        if (!array_key_exists($productId, $this->productsIds))
            $this->productsIds[$productId] = 0;

        // increment quantity
        $this->productsIds[$productId]++;
        $this->count++;

        var_dump($this->productsIds);
    }

    function count()
    {
        return $this->count;
    }
}

?>