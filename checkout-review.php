<?php

require_once("php/global.php");

// redirect to login if not logged in
if (!isset($_SESSION["user"]))
    redirect("login.php");

$validToken = isset($_GET["token"]) && isset($_SESSION["paypal_order"]) && $_GET["token"] == $_SESSION["paypal_order"]->token;

$order = NULL;

if (isset($_SESSION["paypal_order"]))
    $order = SQL::getOrder($_SESSION["paypal_order"]->orderId);

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Review Order | <?php echo $TITLE ?></title>

        <style type="text/css">
            .modal
            {
                max-width: 320px !important;
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function()
            {
                $('#checkout').leanModal({ dismissible: false });
            });

            function complete_paypal_payment()
            {
                $.get("ajax/complete-paypal-payment.php", function(data)
                {
                    // redirect user to complete page if successful
                    if (data == "Success")
                        window.document.location = "checkout-complete.php";
                    else
                        window.document.location = "checkout-review.php";
                });
            }
        </script>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="container">
                <?php
                    // valid token is required
                    if ($order != NULL && $validToken)
                        require_once("templates/checkout-review-valid.php");
                    else
                        require_once("templates/checkout-review-invalid.php");
                ?>
            </div>
        </main>

        <div id="modal" class="modal">
            <div class="modal-content">
                <p class="grey-text text-darken-1">Finalizing payment...</p>
                <div class="progress blue">
                    <div class="indeterminate blue lighten-5"></div>
                </div>
            </div>
        </div>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
