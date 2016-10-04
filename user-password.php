<?php

require_once("php/global.php");

// redirect to login if not logged in
if (!isset($_SESSION["user"]))
    redirect("login.php");

// password change request
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["cur-password"]) && isset($_POST["new-password"]) && isset($_POST["retype-new-password"]))
    $res = SQL::updatePassword($_SESSION["user"]->id, $_POST["cur-password"], $_POST["new-password"], $_POST["retype-new-password"]);

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Password | <?php echo $TITLE ?></title>
        <script>
            $(document).ready(function()
            {
                // initialize password tooltip
                onPasswordChange();
            });

            function onPasswordChange()
            {
                var password = $("#new-password");
                var validity = $("#password-validity");

                // update validity message
                if (password.is(":valid"))
                    validity.html("Valid").css("color", "#689f38");
                else
                    validity.html("Invalid").css("color", "#d32f2f");

                // update strength bar
                var val = password.val();
                $("#password-bar").css({ "background-color": getPasswordColor(val), "width": getPasswordStrength(val) + "%" });
            }
        </script>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m3">
                    <?php require_once("templates/side-nav-user.php"); createSideNav("Password") ?>
                </div>
                
                <div class="col s12 m9">
                    <h5>Change Password</h5>

                    <div class="row container">
                        <?php
                            if (isset($res))
                            {
                                echo "<div class='col s12'>";

                                if ($res === true)
                                    echo "<div class='confirm-box'>Password changed successfully.</div>";
                                else
                                    echo "<div class='error-box'>{$res}</div>";

                                echo "</div>";
                            }
                        ?>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="input-field col s12">
                                <input id="cur-password" name="cur-password" type="password" required />
                                <label for="cur-password">Current password</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="new-password" name="new-password" type="password" onkeyup="onPasswordChange()" required
                                    pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$" />
                                <label for="new-password">New password</label>
                                <div class="tooltip grey lighten-5 grey-text text-darken-3 z-depth-1 left-align">
                                    Password must be between 8-20 characters. It must contain at least one of each: Lowercase, Uppercase letters, Numbers, Symbols.
                                    <p><strong id="password-validity"></strong></p>
                                    <p><strong>Strength:</strong><br><span id="password-bar" class="strength-bar"></span></p>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <input id="retype-new-password" name="retype-new-password" type="password" required />
                                <label for="retype-new-password">Retype new password</label>
                            </div>
                            <div class="col s12">
                                <button class="btn waves-effect waves-light btn-flat blue white-text" type="submit">Change password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
