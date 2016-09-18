<?php

require_once("php/global.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Cart | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <?php
                if (isset($_SESSION["cart"]) && $_SESSION["cart"]->qty() > 0)
                    require_once("templates/cart-table.php");
                else
                    require_once("templates/cart-empty.php");
            ?>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
