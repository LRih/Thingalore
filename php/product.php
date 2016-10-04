<?php

class Product
{
    public $id;
    public $name;
    public $desc;
    public $manufacturer;
    public $series;
    public $rrp;
    public $price;
    public $image;

    function __construct($id, $name, $desc, $manufacturer, $series, $rrp, $price, $image)
    {
        // htmlspecialchars removes XSS threat
        $this->id = $id;
        
        $this->name = htmlspecialchars($name);
        $this->desc = htmlspecialchars($desc);

        $this->manufacturer = htmlspecialchars($manufacturer);
        $this->series = htmlspecialchars($series);

        $this->rrp = $rrp;
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
            array_key_exists("series", $row) ? $row["series"] : NULL,
            array_key_exists("rrp", $row) ? $row["rrp"] : NULL,
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
        return round((1 - $this->price / $this->rrp) * 100);
    }

    function price()
    {
        return $this->price != NULL ? $this->price : $this->rrp;
    }

    function formattedRRP()
    {
        return "$ ".number_format($this->rrp / 100, 2, '.', ',');
    }
    function formattedPrice()
    {
        return "$ ".number_format($this->price() / 100, 2, '.', ',');
    }
}

?>