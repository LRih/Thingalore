<?php

require_once("php/global.php");

// TODO check signed in
// TODO check cart has items

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Processing payment...</title>

        <script type="text/javascript">
            // AJAX request for paypal order token
            $.get("ajax/get-paypal-token.php", function(data)
            {
                // redirect user to PayPal
                window.document.location = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=" + data;
            });
        </script>
    </head>

    <body id="main">
        <div class="section">
            <div class="container row">
                <div class="col s0 m4"></div>

                <div class="col s12 m4 card grey lighten-5 center-align">
                    <p class="grey-text text-darken-1">Redirecting to PayPal...</p>
                    <div class="progress blue">
                        <div class="indeterminate blue lighten-5"></div>
                    </div>
                </div>

                <div class="col s0 m4"></div>
            </div>
        </div>
    </body>
</html>
