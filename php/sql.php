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

        // show newest products first with ORDER BY
        if ($result = $con->query("SELECT * FROM Products ORDER BY id DESC"))
        {
            while ($row = $result->fetch_assoc())
                array_push($products, new Product($row["id"], $row["name"], $row["description"], $row["price"], $row["image"]));
        }

        $con->close();

        return $products;
    }

    public static function getProductsByCategory($category)
    {
        $con = sql::connection();

        if ($con->connect_error)
            return [];

        $products = [];

        $query = "SELECT Products.id, Products.name, Products.description, Products.price, Products.image ".
                 "FROM Products, ProductCategories ".
                 "WHERE Products.category_id = ProductCategories.id AND LOWER(ProductCategories.name) = ? ".
                 "ORDER BY id DESC";

        // prepared statements prevent SQL injection (I'm sure)
        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("s", $category) && $statement->execute())
            {
                $statement->bind_result($id, $name, $desc, $price, $image);

                while ($statement->fetch())
                    array_push($products, new Product($id, $name, $desc, $price, $image));
            }
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

        $query = "SELECT Products.id, Products.name, Products.description, Products.price, Products.image FROM Products WHERE id = ?";

        // prepared statements prevent SQL injection (I'm sure)
        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("s", $id) && $statement->execute())
            {
                $statement->bind_result($id, $name, $desc, $price, $image);

                if ($statement->fetch())
                    $product = new Product($id, $name, $desc, $price, $image);
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

    public static function isCategoryValid($category)
    {
        $con = sql::connection();

        if ($con->connect_error)
            return false;

        $valid = false;

        // prepared statements prevent SQL injection (I'm sure)
        if ($statement = $con->prepare("SELECT ProductCategories.name FROM ProductCategories WHERE LOWER(name) = ?"))
        {
            if ($statement->bind_param("s", $category) && $statement->execute())
            {
                $statement->bind_result($name);

                // category found thus is valid
                if ($statement->fetch())
                    $valid = true;
            }
        }

        $con->close();

        return $valid;
    }

    private static function connection()
    {
        if ($GLOBALS["test_mode"])
            return new mysqli('localhost', 'root', '', 'sec_ecommerce'); // test db
        else
            return new mysqli('localhost', 'sec_ecommerce', 'sec_ecommerce', 'sec_ecommerce'); // production db
    }
}

?>
