<?php

require_once("php/global.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Checkout | <?php echo $TITLE ?></title>

        <script type="text/javascript">
            // test code
            var testToken = <?php echo isset($_GET["token"]) ? "'".$_GET["token"]."'" : "''"; ?>;

            // AJAX request for paypal order details
            $.get("ajax/get-paypal-order.php?token=" + testToken, function(data)
            {
                $("#test").html(data);
            });
        </script>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="container">
                <h5>Review Order</h5>
                <p class="red-text">TODO This page is displayed after PayPal payment and gives the customer a chance to review their order before confirming payment.</p>
                <div id="test" class="center-align">
                    <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                    <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                    </div>
                    </div>
                </div>

                <div class="section">
                    <a href="checkout.php" class="waves-effect waves-light btn-flat blue white-text right">Place Order</a>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
