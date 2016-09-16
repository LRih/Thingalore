<?php

require_once("data/global.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Login</title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12">
                            <h5>New Customer</h5>
                            <b>Register Account</b>
                            <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                            <a class="waves-effect waves-light btn-flat blue white-text">Continue</a>
                        </div>
                    </div>
                </div>

                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12">
                            <h5>Returning Customer</h5>
                            <b>I am a returning customer</b>
                        </div>
                        <form>
                            <div class="input-field col s12">
                                <input id="email" type="email" class="validate">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="password" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                            <div class="col s12">
                                <button class="btn waves-effect waves-light btn-flat blue white-text" type="submit" name="action">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
