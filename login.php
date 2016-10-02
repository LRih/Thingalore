<?php

require_once("php/global.php");

// redirect to profile if already logged in
if (isset($_SESSION["user"]))
    redirect("user-profile.php");

$incorrectCredentials = false;

// only allow logins from post
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["email"]) && isset($_POST["password"]))
{
    $customer = SQL::getCustomerByLogin($_POST["email"], $_POST["password"]);

    // set user and redirect
    if ($customer != NULL)
    {
        $_SESSION["user"] = $customer;
        redirect("index.php");
    }
    else
        $incorrectCredentials = true; // invalid credentials
}

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Login | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m6">
                    <div class="row section">
                        <div class="col s12">
                            <h5>New Customer</h5>
                            <strong>Register Account</strong>
                            <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                            <a href="register.php" class="waves-effect waves-light btn-flat blue white-text">Continue</a>
                        </div>
                    </div>
                </div>

                <div class="col s12 m6">
                    <div class="row section">
                        <div class="col s12">
                            <h5>Returning Customer</h5>
                            <strong>I am a returning customer</strong>
                        </div>
                        <?php
                            if ($incorrectCredentials)
                            {
                                echo "<div class='col s12'>";
                                echo "    <div class='error-box'>";
                                echo "        The credentials you entered are incorrect.";
                                echo "    </div>";
                                echo "</div>";
                            }
                        ?>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="input-field col s12">
                                <input id="email" name="email" type="text" required />
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="password" name="password" type="password" required />
                                <label for="password">Password</label>
                            </div>
                            <div class="row col s12">
                                <a href="#">Forget your password?</a>
                            </div>
                            <div class="col s12">
                                <button class="btn waves-effect waves-light btn-flat blue white-text" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <?php 

        require_once("templates/footer.php") ?>
    </body>
</html>
