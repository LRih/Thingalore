<!--
    TO DO:
    - Message, "REGISTRATION SUCCESSFULL" 
        > Make sure page can't be viewed unless actually registered?
        > Expires?

    DONE:
    - Client side validation: all fields are entered
    - Captcha must be entered
    - Address drop down boxes
    - Password mix of capital, lowercase, numbers and symbols
    - Captcha is true
-->

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
    $captcha = isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'];

    #Captcha = true
    if (!$captcha)
        $error = "Please check the the captcha form.";
    else
    {
        ################# DATA INTO DATABASE ###
        $error = SQL::createCustomer($fname, $lname, $fulladdress, $phone, $email, $pwd);

        // register successful
        if ($error === true)
            redirect("register_success.php");
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

                // initialize password strength to one
                $("#password-bar").css("width", "1%");
            });

            function onPasswordChange(e)
            {
                var val = $("#password").val();

                var length = Math.min(Math.max(val.length * 10, 1), 100);

                // determine color based on steps
                var col;
                if (length > 75)
                    col = "#cddc39"; // green
                else if (length > 50)
                    col = "#ffeb3b"; // yellow
                else if (length > 25)
                    col = "#ffa500"; // orange
                else
                    col = "#f44336"; // red

                $("#password-bar").css({ "background-color": col, "width": length + "%" });
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
                        <div class="input-field col s2"></div>
                        <div class="input-field col s3">
                            <input id="postcode" type="text" class="validate" name="postcode" required 
                                pattern="^\d{4}$" title="4 digits"
                                <?php if (isset($error) && isset($postcode)) echo "value='{$postcode}'" ?> />
                            <label for="postcode">Postcode</label>
                        </div>
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
                            <input id="password" type="password" name="password" required onkeydown="onPasswordChange()"
                                pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$"
                                <?php if (isset($error) && isset($pwd)) echo "value='{$pwd}'" ?> />
                            <label for="password">Password</label>
                            <div class="tooltip grey lighten-5 grey-text text-darken-3 z-depth-1 left-align">
                                Password must be between 8-20 characters. It must contain at least one of each: Lowercase, Uppercase letters, Numbers, Symbols.
                                <p><strong>Strength:</strong><br><span id="password-bar" class="strength-bar"></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email" required
                                <?php if (isset($error) && isset($email)) echo "value='{$email}'" ?> />
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <div class="g-recaptcha" data-sitekey="6LedrSkTAAAAAN7BN1Or_fqjzS4ZbQBVGjerKkt9"></div>

                    <div class="section">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                        <i class="material-icons right">send</i></button>
                    </div>
                </form>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
