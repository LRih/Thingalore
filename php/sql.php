<?php

/**
 * Handling access of data via MySQL.
 */
class SQL
{
    // replace with data from MySQL
    public static function getProducts()
    {
        return [
            array("name" => "DXF One-Punch Man Saitama", "desc" => "Depicted giving one of his famous punches, Saitama from the hit series One-Punch Man is beautifully captured in this exciting painted ABS and PVC figure! With a height of 7.5”, it captures both his realistic form with carefully detailed muscles and his overwhelmingly powerful presence through the pose and dramatic cape, the combination of which can’t help but inspire you. Doesn’t seeing this make you want to cheer him on?!", "price" => 5000),
            array("name" => "Pine Tree", "desc" => "A tree.", "price" => 450),
            array("name" => "Pier", "desc" => "Made of wood.", "price" => 995),
            array("name" => "Pencil", "desc" => "One pencil.", "price" => 1400)
        ];
    }

    // replace with data from MySQL
    public static function getCategories()
    {
        $categories = ["Lakes", "Wood", "Trees"];
        sort($categories);

        return $categories;
    }

    public static function connection()
    {
        // test db
        return new mysqli('localhost', 'root', '', 'sec_ecommernce');

        // production db
        // return new mysqli('localhost', 'sec_ecommernce', 'sec_ecommernce', 'sec_ecommernce');
    }
}

?>
