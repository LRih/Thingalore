<?php

require_once("php/global.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Checkout | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row container section">
                <h5>Checkout</h5>
                <p>This is the checkout page. If user is not logged in, redirect to login page. Otherwise show the standard checkout UI.</p>
                <a href="mock-paypal.php"><img src="images/checkout.png"></a>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
