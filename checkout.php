<?php

require_once("php/global.php");

// TODO check logged in

// cannot checkout with empty cart
if (!isset($_SESSION["cart"]) || $_SESSION["cart"]->qty() == 0)
    redirect("cart.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Checkout | <?php echo $TITLE ?></title>

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

            function get_paypal_token()
            {
                $.get("ajax/get-paypal-token.php", function(data)
                {
                    // redirect user to PayPal if successful
                    if (data)
                        window.document.location = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=" + data;
                    else
                    {
                        Materialize.toast("Error processing payment");
                        $('#modal').closeModal();
                    }
                });
            }
        </script>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="container">
                <h5>Checkout</h5>

                <div class="section">
                    <?php require_once("templates/checkout-table.php") ?>

                    <div class="row">
                        <div class="col s12 center-align">
                            <a id="checkout" href="#modal" onclick="get_paypal_token()"><img src="images/checkout.png"></a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div id="modal" class="modal">
            <div class="modal-content">
                <p class="grey-text text-darken-1">Redirecting to PayPal...</p>
                <div class="progress blue">
                    <div class="indeterminate blue lighten-5"></div>
                </div>
            </div>
        </div>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
