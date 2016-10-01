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
if (captcha != 0) { header('register_success.php'); }
require_once("php/global.php");

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
            });
            $(document).ready(function(){
                $('.tooltipped').tooltip({delay: 50});
            });
        </script>

        <main id="main">
            <div class="center-align">
                <h5>Registration</h5>
                <div class="center-align" style="width:600px; margin-right:auto; margin-left:auto;">
                
                <!-- Display warning if captcha not entered -->
                <?php 
                    if(!($_POST['g-recaptcha-response']) and $_POST["state"])
                        { echo 'Please check the the captcha form.'; }
                ?>
                
                <form class="col s12" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row">
                        <div class="input-field col s6" >
                            <input id="first_name" type="text" class="validate" name="first_name" required aria-required=”true”/>
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="last_name" type="text" class="validate" name="last_name" required aria-required=”true”/>
                            <label for="last_name">Last Name</label>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="address" type="text" class="validate" name="address" required aria-required=”true”/>
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col s4">
                        <select name="state" required aria-required=”true”>
                            <option disabled selected>State</option>
                            <option value="NSW">NSW</option>
                            <option value="NT">NT</option>
                            <option value="QLD">QLD</option>
                            <option value="SA">SA</option>
                            <option value="TAS">TAS</option>
                            <option value="VIC">VIC</option>
                            <option value="WA">WA</option>
                        </select>
                        </div>
                        <div class="input-field col s2"></div>
                        <div class="input-field col s3">
                            <input id="postcode" type="text" class="validate" name="postcode" required aria-required=”true”/>
                            <label for="postcode">Postcode</label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <input id="phone" type="text" class="validate" name="phone" required aria-required=”true”/>
                            <label for="phone">Telephone</label>
                            <div class="tooltip grey lighten-5 grey-text text-darken-3 z-depth-1 left-align">
                                Tooltip with strength bar. Color and length adjustable in JS
                                <p><strong>Strength:</strong><br><span id="strength-bar"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" >
                            <input id="password" type="password" name="password" required aria-required=”true”
                                pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$"
                                class="tooltipped" data-delay="50"
                                data-tooltip="Password must be between 8-20 characters. It must contain at least one of each: 
                                Lowercase, Uppercase letters, Numbers, Symbols."/>
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email" required aria-required=”true”/>
                            <label for="email">Email</label>
                            <div class="tooltip grey lighten-5 grey-text text-darken-3 z-depth-1">CSS customizable tooltip, remove if you want. Visible when input gets focus.</div>
                        </div>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LedrSkTAAAAAN7BN1Or_fqjzS4ZbQBVGjerKkt9"></div>
                    <div>
                        <button href="register_success.php" class="btn waves-effect waves-light" type="submit" name="action">Submit
                        <i class="material-icons right">send</i></button>
                        </a>
                    </div>
                </form>
                </div>
            </div>
        </main>

        <?php
        ####### TO BE INPUT INTO SEPARATE FILE ########
        $fname;$lname;$address;$phone;$email;$pwd;$captcha;
        
        function encrypt($pass) {
                return password_hash($pass, PASSWORD_BCRYPT);
        }

        ################ CHECKING CAPTCHA ###########
        if(isset($_POST['g-recaptcha-response'])){
            $captcha=$_POST['g-recaptcha-response'];
        }
        #False check for captcha in code
        
        #Captcha = true
        if($captcha != 0)
        {
            #Save values after form submit
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = $_POST["first_name"];
                $lname = $_POST["last_name"];
                $address = $_POST["address"].", ".$_POST["state"].", ".$_POST["postcode"];
                $phone = $_POST["phone"];
                $email = $_POST["email"];
                $pwd = encrypt($_POST["password"]);
            }

            ################# DATA INTO DATABASE ###
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sec_ecommerce";

            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "INSERT INTO CUSTOMERS (fname, lname, email, address, phone, password_hash, is_verified, verification_code) 
                VALUES ('$fname', '$lname', '$email', '$address', '$phone', '$pwd', 0, 'insert_code_here')";
            $conn->query($sql);
        }

        ?>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
