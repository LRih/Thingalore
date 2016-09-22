<?php

require_once("php/global.php");

if (!isset($_SESSION['allow_checkout_complete']))
    redirect("index.php");

unset($_SESSION['allow_checkout_complete']);

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
            <div class="row container section">
                <h5>Order Complete</h5>
                <p>We have successfully received your order.</p>
                <p>Thank you for shopping at Thingalore!</p>
                <a href="index.php" class="waves-effect waves-light btn-flat blue white-text right">Continue</a>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
