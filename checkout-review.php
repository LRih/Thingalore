<?php

require_once("php/global.php");

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
                var token = <?php echo isset($_GET["token"]) ? "'".$_GET["token"]."'" : "''" ?>;

                $.get("ajax/complete-paypal-payment.php?token=" + token, function(data)
                {
                    // redirect user to complete page if successful
                    if (data)
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
                    if (isset($_GET["token"]) && isset($_SESSION["paypal_token"]) && $_SESSION["paypal_token"] == $_GET["token"])
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
