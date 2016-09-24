<?php

require_once("php/global.php");

// redirect to login if not logged in
if (!isset($_SESSION["user"]))
    redirect("login.php");

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
                                    $orders = SQL::getOrders($_SESSION["user"]->id);

                                    foreach ($orders as $order)
                                    {
                                        echo "<tr class='clickable' onclick='navigate(\"user-order-detail.php?id=".$order->id."\")'>";
                                        echo "    <td class='center-align'>".$order->id."</td>";
                                        echo "    <td class='center-align'>".$order->formattedPrice()."</td>";
                                        echo "    <td class='center-align'>".$order->date."</td>";
                                        echo "    <td class='center-align'>".$order->status."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="center-align">
                        <ul class="pagination">
                            <li class="disabled"><a><i class="material-icons">chevron_left</i></a></li>
                            <li class="active blue lighten-1"><a href="<?php echo $_SERVER['REQUEST_URI'] ?>">1</a></li>
                            <li class="disabled"><a><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
