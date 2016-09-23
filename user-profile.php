<?php

require_once("php/global.php");

// redirect to login if not logged in
if (!isset($_SESSION["user"]))
    redirect("login.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Profile | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m3">
                    <?php require_once("templates/side-nav-user.php"); createSideNav("Profile") ?>
                </div>
                
                <div class="col s12 m9">
                    <h5>Profile</h5>
                    <p><?php echo $_SESSION["user"]->name(); ?></p>
                    <p><?php echo $_SESSION["user"]->email; ?></p>
                    <?php echo $_SESSION["user"]->formattedAddress(); ?>
                    <p><?php echo $_SESSION["user"]->phone; ?></p>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
