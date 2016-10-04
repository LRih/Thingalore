<?php

require_once("php/global.php");

// TODO send password recover e-mail

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Forgot Password | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="container">
                <h5 class="">Forgot Password</h5>

                <div class="container">
                    <div class="row">
                        <?php
                            if ($_SERVER['REQUEST_METHOD'] === "POST")
                            {
                                echo "<div class='col s12'>";
                                echo "    <div class='error-box'>Failed to send password reset e-mail. Please try again later.</div>";
                                echo "</div>";
                            }
                        ?>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="input-field col s12">
                                <input id="email" name="email" type="email" required />
                                <label for="email">Email</label>
                            </div>
                            <div class="col s12">
                                <button class="btn waves-effect waves-light btn-flat blue white-text" type="submit">Send password reset e-mail</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
