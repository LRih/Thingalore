<?php

require_once("php/global.php");

function showCaptcha()
{
    return isset($_SESSION["login_failures"]) && $_SESSION["login_failures"] >= 3;
}


// redirect to profile if already logged in
if (isset($_SESSION["user"]))
    redirect("user-profile.php");

// only allow logins from post
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["email"]) && isset($_POST["password"]))
{
    // check captcha solved if shown
    if (showCaptcha() && (!isset($_POST["g-recaptcha-response"]) || !$_POST["g-recaptcha-response"]))
        $error = "Please check the the captcha form.";
    else
    {
        $customer = SQL::getCustomerByLogin($_POST["email"], $_POST["password"]);

        // set user and redirect
        if ($customer != NULL)
        {
            // reset login failure count
            $_SESSION["login_failures"] = 0;

            // set user and redirect
            $_SESSION["user"] = $customer;
            redirect("index.php");
        }
        else
        {
            // invalid credentials
            $error = "The credentials you entered are incorrect.";

            // update number of login failures
            if (!isset($_SESSION["login_failures"]))
                $_SESSION["login_failures"] = 0;
            $_SESSION["login_failures"]++;
        }
    }
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
                            if (isset($error))
                            {
                                echo "<div class='col s12'>";
                                echo "    <div class='error-box'>{$error}</div>";
                                echo "</div>";
                            }
                        ?>
                        <form method="post">
                            <div class="input-field col s12">
                                <input id="email" name="email" type="text" required />
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="password" name="password" type="password" required />
                                <label for="password">Password</label>
                            </div>
                            <div class="row col s12">
                                <a href="forgot-password.php">Forgot your password?</a>
                            </div>
                            
                            <?php
                                // show captcha when login failed too many times
                                if (showCaptcha())
                                {
                                    echo "<div class='row col s12'>";
                                    echo "    <div class='g-recaptcha' data-sitekey='".$GLOBALS["captcha_pub_key"]."'></div>";
                                    echo "</div>";
                                }
                            ?>

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
