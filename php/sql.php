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
            array("name" => "Mountain Lake", "desc" => "Standard size lake filled with water. Mountain not included.", "price" => 350),
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
