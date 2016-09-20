<!--
    TO DO:
    - Phone number valid
    - Address drop down boxes
    - Captcha is true
    - Password mix of capital, lowercase, numbers and symbols
    - Message, "REGISTRATION SUCCESSFULL" or email validation

    DONE:
    - Client side validation: all fields are entered
    - Captcha must be entered
-->

<?php

require_once("php/global.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Register | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="center-align">
                <h5>Registration</h5>
                <div class="center-align" style="width:600px; margin-right:auto; margin-left:auto;">
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
                        <select class="browser-default" name="state">
                            <option value="" disabled selected>State</option>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" >
                            <input id="password" type="password" class="validate" name="password" required aria-required=”true”/>
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email" required aria-required=”true”/>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LedrSkTAAAAAN7BN1Or_fqjzS4ZbQBVGjerKkt9"></div>
                    <div><button class="btn waves-effect waves-light" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button></div>
                </form>
                </div>
            </div>
        </main>

        <?php
        ####### TO BE INPUT INTO SEPARATE FILE ########
        $fname;$lname;$address;$phone;$email;$pwd;$captcha = 1;

        ################ CHECKING CAPTCHA ###########
        if(isset($_POST['g-recaptcha-response'])){
            $captcha=$_POST['g-recaptcha-response'];
        }

        if(!$captcha){
            echo '<h2>Please check the the captcha form.</h2>';
            exit;
        }
            /*else {
                $secretKey = "6LedrSkTAAAAAEgtdp4x6OujcEszFP2i4XA5EwRz";
                $ip = $_SERVER['REMOTE_ADDR'];
                $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                echo $response;
                $responseKeys = json_decode($response,true);
                echo $responseKeys;
                
                if(intval($responseKeys["success"]) !== 1) {
                    echo '<h2>You are spammer !</h2>';
                } 
                else {
                    echo '<h2>DONE</h2>';
                }
            }*/
        
        
        #Save values after form submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = $_POST["first_name"];
            $lname = $_POST["last_name"];
            $address = $_POST["address"].", ".$_POST["state"].", ".$_POST["postcode"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $pwd = encrypt($_POST["password"]);
        }

        function encrypt($pass) {
            return password_hash($pass, PASSWORD_BCRYPT);
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

        ?>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
