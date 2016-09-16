<?php

require_once("data/global.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Cart</title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="container section">
                <h5>Shopping Cart</h5>
                <p>Your shopping cart is empty!</p>
                <a href="index.php" class="waves-effect waves-light btn-flat blue white-text right">Continue</a>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
