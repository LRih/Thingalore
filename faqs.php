<?php

require_once("php/global.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>FAQs | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m3">
                    <?php require_once("templates/side-nav.php"); createSideNav("FAQs") ?>
                </div>
                
                <div class="col s12 m9">
                    <h5>Where does Thingalore ship to?</h5>
                    <p>Currently we only ship to Australian addresses.</p>
                    
                    <div class="section">
                        <h5>What payment options are available?</h5>
                        <p>We accept payments via PayPal.</p>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
