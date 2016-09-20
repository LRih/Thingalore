<?php

require_once("php/global.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Orders | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m3">
                    <?php require_once("templates/side-nav-user.php"); createSideNav("Orders") ?>
                </div>
                
                <div class="col s12 m9">
                    <h5>Orders</h5>
                    <p class="red-text">TODO change with current user's data</p>
                    <div class="section">
                        <table class="bordered highlight">
                            <thead>
                                <tr>
                                    <th class="center-align">Order ID</th>
                                    <th class="center-align">Total</th>
                                    <th class="center-align">Date</th>
                                    <th class="center-align">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $orders = SQL::getOrders(1);

                                    foreach ($orders as $order)
                                    {
                                        echo "<tr class='clickable' onclick='navigate(\"user-order-detail.php\")'>";
                                        echo "    <td class='center-align'>".$order->id."</td>";
                                        echo "    <td class='center-align'>$ XX.YY</td>";
                                        echo "    <td class='center-align'>".$order->date."</td>";
                                        echo "    <td class='center-align'>".$order->status."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
