<?php

require_once("php/global.php");

// TODO implement edit profile

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

                    <div class="section">
                        <?php
                            if ($_SESSION["user"]->isVerified)
                                echo "<span class='confirm-box'>Verified</span>";
                            else
                                echo "<span class='error-box'>Unverified</span>";
                        ?>
                    </div>

                    <div class="section">
                        <h5>Name</h5>
                        <p><?php echo $_SESSION["user"]->name() ?></p>
                    </div>

                    <div class="section">
                        <h5>Address</h5>
                        <?php echo $_SESSION["user"]->formattedAddress() ?>
                    </div>

                    <div class="section">
                        <h5>Contact</h5>
                        <p>E-mail: <?php echo $_SESSION["user"]->email ?><br>Phone: <?php echo $_SESSION["user"]->phone ?></p>
                    </div>
                    
                    <div class="section">
                        <a class="waves-effect waves-light btn-flat blue white-text">Edit</a>
                        <?php
                            if (!$_SESSION["user"]->isVerified)
                                echo "<a class='waves-effect waves-light btn-flat blue white-text'>Resend verification e-mail</a>";
                        ?>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
