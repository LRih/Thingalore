
<?php

require_once("php/global.php");

// redirect to home if not coming from successful registration
if (!isset($_SESSION['register_success']))
    redirect("index.php");

// unset flag so this page cannot be navigated to a second time
unset($_SESSION['register_success']);

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php");?>
        <title>Register | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="center-align">
                <h5>Registration Sucessful!</h5>
                <p>Thank you for joining Thingalore! Begin shopping by logging into your account.</p>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
