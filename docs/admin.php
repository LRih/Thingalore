<?php

require_once("../php/global.php");

$customers = SQL::getCustomers();
$products = SQL::getProducts();

?>

<!DOCTYPE html>

<html>
    <head>
        <!-- JQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

        <!-- Materialize -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link type="text/css" rel="stylesheet" href="../css/style.css" />
        <script type="text/javascript" src="../css/script.js"></script>
        <link href="../images/icon.png" rel="icon" />
        
        <title>Admin | <?php echo $TITLE ?></title>
    </head>

    <body>
        <div id="banner-container" class="orange darken-4">
            <div id="banner" class="valign-wrapper">
                <div class="white-text valign">
                    <a class="white-text left" href="index.php"><img class="valign" src="../images/title.png"></a>
                </div>
            </div>
        </div>

        <main id="main">
            <div class='section'>
                <h5>Customers</h5>
                <table class='responsive-table'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            foreach ($customers as $c)
                            {
                                echo "<tr>";
                                echo "    <td>".$c->id."</td>";
                                echo "    <td>".$c->name()."</td>";
                                echo "    <td>".$c->address."</td>";
                                echo "    <td>".$c->phone."</td>";
                                echo "    <td>".$c->email."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class='section'>
                <h5>Orders</h5>
                <table class='responsive-table'>
                    <thead>
                        <tr>
                            <th>Cust ID</th>
                            <th>ID</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            foreach (SQL::getOrders() as $o)
                            {
                                echo "<tr>";
                                echo "    <td>".$c->id."</td>";
                                echo "    <td>".$o->id."</td>";
                                echo "    <td>".$o->formattedPrice()."</td>";
                                echo "    <td>".$o->date."</td>";
                                echo "    <td>".$o->status."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class='section'>
                <h5>Products</h5>
                <table class='responsive-table'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Manufacturer</th>
                            <th>Series</th>
                            <th>RRP</th>
                            <th>Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            foreach ($products as $p)
                            {
                                echo "<tr>";
                                echo "    <td>".$p->id."</td>";
                                echo "    <td>".$p->name."</td>";
                                echo "    <td>".str_replace("\n", "<br>", $p->desc)."</td>";
                                echo "    <td>".$p->manufacturer."</td>";
                                echo "    <td>".$p->series."</td>";
                                echo "    <td>".$p->formattedRRP()."</td>";
                                echo "    <td>".$p->formattedPrice()."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        
        <footer class="grey lighten-3" style='height: 100px'>
        </footer>
    </body>
</html>
