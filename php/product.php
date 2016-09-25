<?php

class Product
{
    public $id;
    public $name;
    public $desc;
    public $manufacturer;
    public $retailPrice;
    public $price;
    public $image;

    function __construct($id, $name, $desc, $manufacturer, $retailPrice, $price, $image)
    {
        // htmlspecialchars removes XSS threat
        $this->id = $id;
        $this->name = htmlspecialchars($name);
        $this->desc = htmlspecialchars($desc);
        $this->manufacturer = htmlspecialchars($manufacturer);
        $this->retailPrice = $retailPrice;
        $this->price = $price;
        $this->image = htmlspecialchars($image);
    }

    /**
     * Construct object from SQL row.
     */
    public static function fromRow($row)
    {
        return new Product(
            $row["id"],
            $row["name"],
            $row["description"],
            array_key_exists("manufacturer", $row) ? $row["manufacturer"] : NULL,
            array_key_exists("retail_price", $row) ? $row["retail_price"] : NULL,
            $row["price"],
            $row["image"]
        );
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

    function discountPercent()
    {
        return round((1 - $this->price / $this->retailPrice) * 100);
    }

    function formattedRetailPrice()
    {
        return "$ ".number_format($this->retailPrice / 100, 2, '.', ',');
    }
    function formattedPrice()
    {
        return "$ ".number_format($this->price / 100, 2, '.', ',');
    }
}

?>