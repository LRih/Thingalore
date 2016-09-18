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

    /**
     * Surround all lines with <p> tag.
     */
    function formattedDesc()
    {
        $lines = explode("\n", $this->desc);

        $result = "";
        foreach ($lines as $line)
            $result .= "<p>".$line."</p>";

        return $result;
    }

    function formattedPrice()
    {
        return "$ ".number_format($this->price / 100, 2, '.', ',');
    }
}

?>