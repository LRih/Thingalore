<?php

require_once("php/global.php");

// redirect to login if not logged in
if (!isset($_SESSION["user"]))
    redirect("login.php");

// when no id set, redirect to orders page
if (!isset($_GET["id"]))
    redirect("user-orders.php");

$order = SQL::getOrder($_GET["id"]);

// check if order is valid
if ($order == NULL)
    redirect("user-orders.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Order #<?php echo $order->id ?> | <?php echo $TITLE ?></title>
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
                    <h5>Order #<?php echo $order->id ?></h5>
                    <p class="red-text">TODO List items in order and related information.</p>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
