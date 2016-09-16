<?php

require_once("data/global.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Title</title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m3">
                    <?php require_once("templates/side-nav.php"); createSideNav("Home") ?>
                </div>
                
                <div class="col s12 m9">
                    <div class="row">
                        <div class="col s0 m3"></div>
                        <div class="col s12 m6">
                            <div id="main-card" class="card blue-grey darken-1 center-align">
                                <div class="card-content white-text">
                                  <span class="card-title">Unnamed Web Store</span>
                                  <p>Home of future e-commerce website.</p>
                                </div>
                                <div class="card-action">
                                  <a href="#" onclick="onOkClick()">Ok</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s0 m3"></div>
                    </div>

                    <div class="center-align">
                        <div class="g-recaptcha" data-sitekey="6LedrSkTAAAAAN7BN1Or_fqjzS4ZbQBVGjerKkt9"></div>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
