<?php

require_once("php/global.php");

if (!isset($_SESSION['checkout_complete_id']))
    redirect("index.php");

$orderId = $_SESSION['checkout_complete_id'];

unset($_SESSION['checkout_complete_id']);

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
                <p>We have successfully received your order.<br>Thank you for shopping at Thingalore!</p>
                <p>View your order details <a href="user-order-detail.php?id=<?php echo $orderId ?>">here</a>.</p>
                <a href="index.php" class="waves-effect waves-light btn-flat blue white-text right">Continue</a>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
