<?php

class Order
{
    public $id;
    public $shippingLabel;
    public $date;
    public $status;
    public $items;

    function __construct($id, $shippingLabel, $date, $status, $items)
    {
        // htmlspecialchars removes XSS threat
        $this->id = $id;
        $this->shippingLabel = $shippingLabel;
        $this->date = htmlspecialchars($date);
        $this->status = htmlspecialchars($status);
        $this->items = $items;
    }

    function formattedShippingLabel()
    {
        $lines = explode("\n", $this->shippingLabel);

        $result = "";
        foreach ($lines as $line)
            $result .= "<p>".$line."</p>";

        return $result;
    }

    function price()
    {
        $price = 0;

        foreach ($this->items as $item)
            $price += $item->price;

        return $price;
    }

    function formattedPrice()
    {
        return "$ ".number_format($this->price() / 100, 2, '.', ',');
    }
}

?>