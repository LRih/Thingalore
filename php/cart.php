<?php

class Cart
{
    public $items = [];

    function __construct()
    {
    }

    function add($product)
    {
        // add product id if not yet added
        if (!array_key_exists($product->id, $this->items))
            $this->items[$product->id] = new CartItem($product);

        // increment quantity
        $this->items[$product->id]->qty++;
    }

    function remove($productId)
    {
        if (array_key_exists($productId, $this->items))
        {
            $this->items[$productId]->qty--;

            // remove key if qty is zero
            if ($this->items[$productId] <= 0)
                unset($this->items[$productId]);
        }
    }

    function removeAll($productId)
    {
        if (array_key_exists($productId, $this->items))
            unset($this->items[$productId]);
    }

    function clear()
    {
        $this->items = [];
    }

    function qty()
    {
        $qty = 0;

        foreach ($this->items as $item)
            $qty += $item->qty;

        return $qty;
    }

    function price()
    {
        $price = 0;

        foreach ($this->items as $item)
            $price += $item->price();

        return $price;
    }

    function formattedPrice()
    {
        return "$ ".number_format($this->price() / 100, 2, '.', ',');
    }
}

?>