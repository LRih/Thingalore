<?php

/**
 * Handling access of data via MySQL.
 */
class SQL
{
    public static function getProducts()
    {
        return [
            array("name" => "Mountain Lake", "desc" => "Standard size lake filled with water. Mountain not included.", "price" => 350),
            array("name" => "Pine Tree", "desc" => "A tree.", "price" => 450),
            array("name" => "Pier", "desc" => "Made of wood.", "price" => 995),
            array("name" => "Pencil", "desc" => "One pencil.", "price" => 1400)
        ];
    }
}

?>
