<?php

require_once("php/global.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = htmlentities(trim($_POST["first_name"]));
    $lname = htmlentities(trim($_POST["last_name"]));

    $address = htmlentities(trim($_POST["address"]));
    $state = htmlentities(trim($_POST["state"]));
    $postcode = htmlentities(trim($_POST["postcode"]));
    $fulladdress = $address.", ".$state.", ".$postcode;

    $phone = htmlentities(trim($_POST["phone"]));
    $email = htmlentities(trim($_POST["email"]));

    $pwd = $_POST["password"];

    ################ CHECKING CAPTCHA ###########
    $captcha = $_POST['g-recaptcha-response'];

    #Captcha = true
    if (!isset($captcha))
        $error = "Please check the the captcha form.";
    else
    {
        ################# DATA INTO DATABASE ###
        $captcha = "https://www.google.com/recaptcha/api/siteverify?secret=".$GLOBALS["captcha_pub_key"]."&response=".$captcha;

        $response = file_get_contents($captcha);
        $responseData = json_decode($response);

        //If captcha true
        if($responseData->success)
        {
            $error = SQL::createCustomer($fname, $lname, $fulladdress, $phone, $email, $pwd);

            if ($error === true)
            {
                // flag register success
                $_SESSION['register_success'] = true;

                redirect("register-success.php");
            }
        }   
        else
            $error = "Please check the the captcha form.";

    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            require_once("templates/head.php");?>
        <title>Register | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>
        <script>
            $(document).ready(function() {
                $('select').material_select();

                // initialize password tooltip
                onPasswordChange();

                //Check password and pass_verify match
                $("#password, #pass_verify").keyup(checkPasswordMatch);
            });

            function onPasswordChange()
            {
                var password = $("#password");
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

            // For password verification
            function checkPasswordMatch() 
            {
                var password = $("#password").val();
                var confirmPassword = $("#pass_verify").val();

                if (password != confirmPassword)
                    $("#pass_verify_text").html("Passwords do not match!");
                else
                    $("#pass_verify_text").html("Passwords match.");
            }
        </script>

        <main id="main">
            <h5 class="center-align">Registration</h5>

            <div class="center-align" style="max-width:600px; margin-right:auto; margin-left:auto;">
            
                <!-- Display warning if captcha not entered -->
                <?php 
                    if (isset($error))
                        echo "<div class='error-box'>{$error}</div>";
                ?>
                
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row">
                        <div class="input-field col s6" >
                            <input id="first_name" type="text" class="validate" name="first_name" required
                                <?php if (isset($error) && isset($fname)) echo "value='{$fname}'" ?> />
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="last_name" type="text" class="validate" name="last_name" required
                                <?php if (isset($error) && isset($lname)) echo "value='{$lname}'" ?> />
                            <label for="last_name">Last Name</label>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="address" type="text" class="validate" name="address" required
                                <?php if (isset($error) && isset($address)) echo "value='{$address}'" ?> />
                            <label for="address">Address</label>
                            <div class="tooltip grey lighten-5 grey-text text-darken-3 z-depth-1 left-align">We only ship to Australian addresses.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s1"></div>
                        <div class="input-field col s4">
                            <select name="state" required>
                                <option disabled <?php if (!isset($error) || !isset($state)) echo "selected" ?>>State</option>
                                <option value="NSW" <?php if (isset($error) && isset($state) && $state == "NSW") echo "selected" ?>>NSW</option>
                                <option value="NT" <?php if (isset($error) && isset($state) && $state == "NT") echo "selected" ?>>NT</option>
                                <option value="QLD" <?php if (isset($error) && isset($state) && $state == "QLD") echo "selected" ?>>QLD</option>
                                <option value="SA" <?php if (isset($error) && isset($state) && $state == "SA") echo "selected" ?>>SA</option>
                                <option value="TAS" <?php if (isset($error) && isset($state) && $state == "TAS") echo "selected" ?>>TAS</option>
                                <option value="VIC" <?php if (isset($error) && isset($state) && $state == "VIC") echo "selected" ?>>VIC</option>
                                <option value="WA" <?php if (isset($error) && isset($state) && $state == "WA") echo "selected" ?>>WA</option>
                            </select>
                        </div>
                        
                        <div class="col s2"></div>

                        <div class="input-field col s4">
                            <input id="postcode" type="text" class="validate" name="postcode" required 
                                pattern="^\d{4}$"
                                <?php if (isset($error) && isset($postcode)) echo "value='{$postcode}'" ?> />
                            <label for="postcode">Postcode</label>
                            <div class="tooltip grey lighten-5 grey-text text-darken-3 z-depth-1 left-align">4 digits.</div>
                        </div>
                        <div class="col s1"></div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="phone" type="text" class="validate" name="phone" required
                                pattern="^\d+$"
                                <?php if (isset($error) && isset($phone)) echo "value='{$phone}'" ?> />
                            <label for="phone">Telephone</label>
                            <div class="tooltip grey lighten-5 grey-text text-darken-3 z-depth-1 left-align">Please enter only numbers.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12" >
                            <input id="password" type="password" class="validate" name="password" required onkeyup="onPasswordChange()"
                                pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$" />
                            <label for="password">Password</label>
                            <div class="tooltip grey lighten-5 grey-text text-darken-3 z-depth-1 left-align">
                                Password must be between 8-20 characters. It must contain at least one of each: Lowercase, Uppercase letters, Numbers, Symbols.
                                <p><strong id="password-validity"></strong></p>
                                <p><strong>Strength:</strong><br><span id="password-bar" class="strength-bar"></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12" >
                            <input id="pass_verify" type="password" class="validate" name="pass_verify" required onChange="checkPasswordMatch();"/>
                            <label for="pass_verify">Verify Password</label>
                            <div id="pass_verify_text" class="tooltip grey lighten-5 grey-text text-darken-3 z-depth-1 left-align">
                                Retype password.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email" required
                                <?php if (isset($error) && isset($email)) echo "value='{$email}'" ?> />
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <div class="g-recaptcha" data-sitekey="<?php echo $GLOBALS["captcha_pub_key"] ?>"></div>

                    <div class="section">
                        <button class="btn waves-effect waves-light btn-flat blue white-text" type="submit" name="action">Submit
                        <i class="material-icons right">send</i></button>
                    </div>
                </form>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
