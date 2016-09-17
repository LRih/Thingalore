<?php

require_once("product.php");

/**
 * Handling access of data via MySQL.
 */
class SQL
{
    public static function getProducts()
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return [];

        $products = [];

        if ($result = $con->query("SELECT * FROM Products"))
        {
            while ($row = $result->fetch_assoc())
                array_push($products, new Product($row["id"], $row["name"], $row["description"], $row["price"], $row["image"]));
        }

        $con->close();

        return $products;
    }

    public static function getProduct($id)
    {
        $con = sql::connection();

        if ($con->connect_error)
            return NULL;

        $product = NULL;

        // prepared statements prevent SQL injection
        if ($statement = $con->prepare("SELECT * FROM Products WHERE id = ?"))
        {
            if ($statement->bind_param("s", $id) && $statement->execute())
            {
                $result = $statement->get_result();

                if ($row = $result->fetch_assoc())
                    $product = new Product($row["id"], $row["name"], $row["description"], $row["price"], $row["image"]);
            }
        }

        $con->close();

        return $product;
    }

    public static function getCategories()
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return [];

        $categories = [];

        if ($result = $con->query("SELECT * FROM ProductCategories"))
        {
            while ($row = $result->fetch_assoc())
                array_push($categories, $row["name"]);
        }

        $con->close();

        sort($categories);
        return $categories;
    }

    public static function connection()
    {
        // test db
        return new mysqli('localhost', 'root', '', 'sec_ecommerce');

        // production db
        // return new mysqli('localhost', 'sec_ecommerce', 'sec_ecommerce', 'sec_ecommerce');
    }
}

?>
