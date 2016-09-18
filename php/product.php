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
        // htmlspecialchars removes XSS threat
        $this->id = $id;
        $this->name = htmlspecialchars($name);
        $this->desc = htmlspecialchars($desc);
        $this->price = $price;
        $this->image = htmlspecialchars($image);
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