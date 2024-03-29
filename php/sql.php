<?php

/**
 * Handling access of data via MySQL.
 */
class SQL
{
    //========================================================================= PRODUCTS
    public static function getProducts()
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return [];

        $products = [];

        // show newest products first with ORDER BY
        if ($result = $con->query("SELECT * FROM Products ORDER BY id DESC"))
        {
            $rows = SQL::fetch($result);

            foreach ($rows as $row)
                array_push($products, Product::fromRow($row));
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

        $query = "SELECT Products.* ".
                 "FROM Products, ProductCategories ".
                 "WHERE Products.category_id = ProductCategories.id AND LOWER(ProductCategories.name) = ? ".
                 "ORDER BY id DESC";

        // prepared statements prevent SQL injection (I'm sure)
        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("s", $category) && $statement->execute())
            {
                $rows = SQL::fetch($statement);

                foreach ($rows as $row)
                    array_push($products, Product::fromRow($row));
            }
        }

        $con->close();

        return $products;
    }

    public static function getProductsByManufacturer($manufacturer, $excludedId)
    {
        $con = sql::connection();

        if ($con->connect_error)
            return [];

        $products = [];

        $query = "SELECT * ".
                 "FROM Products ".
                 "WHERE manufacturer = ? AND id <> ? ".
                 "ORDER BY RAND() LIMIT 5";

        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("si", $manufacturer, $excludedId) && $statement->execute())
            {
                $rows = SQL::fetch($statement);

                foreach ($rows as $row)
                    array_push($products, Product::fromRow($row));
            }
        }

        $con->close();

        return $products;
    }

    public static function getProductsBySeries($series, $excludedId)
    {
        $con = sql::connection();

        if ($con->connect_error)
            return [];

        $products = [];

        $query = "SELECT * ".
                 "FROM Products ".
                 "WHERE series = ? AND id <> ? ".
                 "ORDER BY RAND() LIMIT 5";

        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("si", $series, $excludedId) && $statement->execute())
            {
                $rows = SQL::fetch($statement);

                foreach ($rows as $row)
                    array_push($products, Product::fromRow($row));
            }
        }

        $con->close();

        return $products;
    }

    /**
     * Very rudimentary search procedure.
     */
    public static function getProductsLikeName($name)
    {
        $name = "%".$name."%";

        $con = sql::connection();

        if ($con->connect_error)
            return [];

        $products = [];

        $query = "SELECT * ".
                 "FROM Products ".
                 "WHERE LOWER(Products.name) LIKE LOWER(?) ".
                 "ORDER BY id DESC";

        // prepared statements prevent SQL injection (I'm sure)
        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("s", $name) && $statement->execute())
            {
                $rows = SQL::fetch($statement);

                foreach ($rows as $row)
                    array_push($products, Product::fromRow($row));
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

        $query = "SELECT * FROM Products WHERE id = ?";

        // prepared statements prevent SQL injection (I'm sure)
        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("s", $id) && $statement->execute())
            {
                $rows = SQL::fetch($statement);

                if (count($rows) > 0)
                    $product = Product::fromRow($rows[0]);
            }
        }

        $con->close();

        return $product;
    }


    //========================================================================= CATEGORIES
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
        $con = SQL::connection();

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


    //========================================================================= CUSTOMERS
    private static function encrypt($pass) {
        return password_hash($pass, PASSWORD_BCRYPT);
    }

    public static function getCustomers()
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return [];

        $customers = [];

        if ($result = $con->query("SELECT * FROM Customers"))
        {
            while($row = $result->fetch_assoc())
                array_push($customers, Customer::fromRow($row));
        }

        $con->close();

        return $customers;
    }

    public static function getCustomer($id)
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return NULL;

        $customer = NULL;

        $query = "SELECT * FROM Customers WHERE id = ?";

        // prepared statements prevent SQL injection
        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("s", $id) && $statement->execute())
            {
                $rows = SQL::fetch($statement);

                if (count($rows) > 0)
                    $customer = Customer::fromRow($rows[0]);
            }
        }

        $con->close();

        return $customer;
    }

    /**
     * NULL indicates invalid credentials.
     */
    public static function getCustomerByLogin($email, $password)
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return NULL;

        $customer = NULL;
        $query = "SELECT id, password_hash FROM Customers WHERE (email=?)";

        // prepared statements prevent SQL injection (I'm sure)
        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("s", $email) && $statement->execute())
            {
                $row = SQL::fetch($statement); //Contains id and hash

                if (count($row) > 0)
                {
                    //Check if passwords match
                    if (password_verify($password, $row[0]['password_hash']))
                        $customer = SQL::getCustomer($row[0]['id']);
                }
            }
        }

        $con->close();

        return $customer;
    }

    public static function insertCustomer($fname, $lname, $address, $phone, $email, $pwd)
    {
        // validation
        if (SQL::isEmailExist($email))
            return 'E-mail already exists.';
        else if (!Validator::checkPassword($pwd))
            return 'Password must be between 8-20 characters. It must contain at least one of each: Lowercase, Uppercase letters, Numbers, Symbols.';

        $ret = 'Operation failed.';
        $con = SQL::connection();

        if ($con->connect_error)
            return $ret;

        $pwd = SQL::encrypt($pwd);

        $query = "INSERT INTO Customers (fname, lname, email, address, phone, password_hash, verification_code) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $ver_code = md5(rand(40000, 50000));

        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("sssssss", $fname, $lname, $email, $address, $phone, $pwd, $ver_code) && $statement->execute())
                $ret = true;
        }

        $con->close();
        
        return $ret;
    }

    public static function isEmailExist($email)
    {
        $con = SQL::connection();

        // for safety, just say e-mail exists if operation fails
        if ($con->connect_error)
            return true;

        $exists = true;
        $query = "SELECT * FROM Customers WHERE email = ?";

        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("s", $email) && $statement->execute())
            {
                $rows = SQL::fetch($statement);

                if (count($rows) == 0)
                    $exists = false;
            }
        }

        $con->close();

        return $exists;
    }

    /**
     * Check password for particular user.
     */
    private static function checkPassword($id, $password)
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return false;

        $success = false;
        $query = "SELECT password_hash FROM Customers WHERE id = ?";

        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("i", $id) && $statement->execute())
            {
                $rows = SQL::fetch($statement);

                if (count($rows) > 0 && password_verify($password, $rows[0]['password_hash']))
                    $success = true;
            }
        }

        $con->close();

        return $success;
    }

    public static function updatePassword($id, $curPwd, $newPwd, $retypeNewPwd)
    {
        // validation
        if (!SQL::checkPassword($id, $curPwd))
            return 'Current password is incorrect.';
        else if (!Validator::checkPassword($newPwd))
            return 'Password must be between 8-20 characters. It must contain at least one of each: Lowercase, Uppercase letters, Numbers, Symbols.';
        else if ($newPwd != $retypeNewPwd)
            return 'Passwords do not match.';


        $ret = 'Operation failed.';
        $con = SQL::connection();

        if ($con->connect_error)
            return $ret;

        if ($statement = $con->prepare("UPDATE Customers SET password_hash = ? WHERE id = ?"))
        {
            $pwd = SQL::encrypt($newPwd);
            if ($statement->bind_param("si", $pwd, $id) && $statement->execute())
                $success = true;
        }

        $con->close();

        return $success;
    }


    //========================================================================= ORDERS
    public static function getOrders()
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return [];

        $orders = [];

        $query = "SELECT id, shipping_label, DATE_FORMAT(order_date, '%d/%m/%Y'), status ".
                 "FROM Orders ".
                 "ORDER BY id DESC";

        if ($statement = $con->prepare($query))
        {
            if ($statement->execute())
            {
                $statement->bind_result($id, $shippingLabel, $date, $status);

                while ($statement->fetch())
                    array_push($orders, new Order($id, $shippingLabel, $date, $status, SQL::getOrderLines($id)));
            }
        }

        $con->close();

        return $orders;
    }

    public static function getOrdersByCustomer($customerId)
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return [];

        $orders = [];

        $query = "SELECT id, shipping_label, DATE_FORMAT(order_date, '%d/%m/%Y'), status ".
                 "FROM Orders ".
                 "WHERE customer_id = ? AND status <> 'Incomplete'".
                 "ORDER BY order_date DESC, id DESC";

        // prepared statements prevent SQL injection (I'm sure)
        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("i", $customerId) && $statement->execute())
            {
                $statement->bind_result($id, $shippingLabel, $date, $status);

                while ($statement->fetch())
                    array_push($orders, new Order($id, $shippingLabel, $date, $status, SQL::getOrderLines($id)));
            }
        }

        $con->close();

        return $orders;
    }

    public static function getOrder($orderId)
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return NULL;

        $order = NULL;

        $query = "SELECT id, shipping_label, DATE_FORMAT(order_date, '%d/%m/%Y'), status FROM Orders WHERE id = ?";

        // prepared statements prevent SQL injection
        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("i", $orderId) && $statement->execute())
            {
                $statement->bind_result($id, $shippingLabel, $date, $status);

                if ($statement->fetch())
                    $order = new Order($id, $shippingLabel, $date, $status, SQL::getOrderLines($orderId));
            }
        }

        $con->close();

        return $order;
    }

    public static function insertOrder($customer, $cart, $status)
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return -1;

        // transaction ensures either all queries succeed or none at all
        $con->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

        $orderId = -1;

        // insert order
        if ($statement = $con->prepare("INSERT INTO Orders (customer_id, shipping_label, order_date, status) VALUES (?, ?, NOW(), ?)"))
        {
            $shipping_label = $customer->name()."\n".$customer->address;

            if ($statement->bind_param("iss", $customer->id, $shipping_label, $status) && $statement->execute())
                $orderId = $con->insert_id;
            else
            {
                $con->rollback();
                $con->close();
                return -1;                
            }
        }

        // insert order lines
        $statement = $con->prepare("INSERT INTO OrderLines (order_id, product_id, qty, total_price) VALUES (?, ?, ?, ?)");

        foreach ($cart->items as $item)
        {
            $price = $item->price();

            if (!$statement->bind_param("iiii", $orderId, $item->product->id, $item->qty, $price) || !$statement->execute())
            {
                $con->rollback();
                $con->close();
                return -1;                
            }
        }

        $con->commit();
        $con->close();

        return $orderId;
    }

    public static function updateOrder($orderId, $status)
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return false;

        $success = false;
        if ($statement = $con->prepare("UPDATE Orders SET status = ? WHERE id = ?"))
        {
            if ($statement->bind_param("si", $status, $orderId) && $statement->execute())
                $success = true;
        }

        $con->close();

        return $success;
    }


    //========================================================================= ORDER LINES
    private static function getOrderLines($orderId)
    {
        $con = SQL::connection();

        if ($con->connect_error)
            return [];

        $orderLines = [];

        $query = "SELECT Products.*, OrderLines.qty, OrderLines.total_price FROM Products, OrderLines ".
                 "WHERE Products.id = OrderLines.product_id AND order_id = ?";

        // prepared statements prevent SQL injection
        if ($statement = $con->prepare($query))
        {
            if ($statement->bind_param("i", $orderId) && $statement->execute())
            {
                $rows = SQL::fetch($statement);

                foreach ($rows as $row)
                {
                    $product = Product::fromRow($row);
                    array_push($orderLines, new OrderItem($product, $row["qty"], $row["total_price"]));
                }
            }
        }

        $con->close();

        return $orderLines;
    }


    //========================================================================= MISCELLANEOUS
    /**
     * Fetches all rows from a result set - either normal or prepared.
     * Sourced from php.net by nieprzeklinaj at gmail dot com
     */
    private static function fetch($result)
    {   
        $array = array();
       
        if ($result instanceof mysqli_stmt)
        {
            $result->store_result();
           
            $variables = array();
            $data = array();
            $meta = $result->result_metadata();
           
            while ($field = $meta->fetch_field())
                $variables[] = &$data[$field->name]; // pass by reference
           
            call_user_func_array(array($result, 'bind_result'), $variables);
           
            $i = 0;
            while($result->fetch())
            {
                $array[$i] = array();
                foreach ($data as $k=>$v)
                    $array[$i][$k] = $v;
                $i++;
            }
        }
        elseif ($result instanceof mysqli_result)
        {
            while($row = $result->fetch_assoc())
                $array[] = $row;
        }
       
        return $array;
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