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
            <div class="container">
                <h5>Checkout</h5>

                <div class="section">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <h5>Item details</h5>
                                    <p>Blah blah blah</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <h5>Shipping details</h5>
                                    <p>Blah blah blah</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 m6">
                            <div class="card">
                                <div class="card-content">
                                    <h5>Pay with credit card</h5>
                                    <p>Unavailable</p>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="card">
                                <div class="card-content">
                                    <h5>Pay with PayPal</h5>
                                    <a href="mock-paypal.php"><img src="images/checkout.png"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
