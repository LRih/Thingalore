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
                    <div class="section">
                        <table class="bordered highlight">
                            <thead>
                                <tr>
                                    <th class="center-align">Order ID</th>
                                    <th class="center-align">Date</th>
                                    <th class="center-align">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr onclick="navigate('user-order-detail.php')">
                                    <td class="center-align">123</td>
                                    <td class="center-align">23/04/2016</td>
                                    <td class="center-align">Processing</td>
                                </tr>
                                <tr onclick="navigate('user-order-detail.php')">
                                    <td class="center-align">124</td>
                                    <td class="center-align">01/03/2016</td>
                                    <td class="center-align">Shipped</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
