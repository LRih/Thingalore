<?php

require_once("php/global.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Processing payment...</title>
    </head>

    <body id="main">
        <div class="section">
            <div class="container row">
                <div class="col s0 m4"></div>

                <div class="col s12 m4 card grey lighten-5 center-align">
                    <p class="grey-text text-darken-1">Processing payment<br>via MOCK PayPal</p>
                    <div class="progress blue">
                        <div class="indeterminate blue lighten-5"></div>
                    </div>
                </div>

                <div class="col s0 m4"></div>
            </div>
        </div>
    </body>
</html>
