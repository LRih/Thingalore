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

        <?php
            $fname = $lname = $email = $pwd = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = test_input($_POST["first_name"]);
                $lname = test_input($_POST["last_name"]);
                $email = test_input($_POST["email"]);
                $pwd = test_input($_POST["password"]);
            }

            function test_input($data) {
                # Testing/editing data here
                return $data;
            }

        ?>

        <main id="main">
            <div class="center-align">
                <h5>Registration</h5>
                <div class="center-align" style="width:600px; margin-right:auto; margin-left:auto;">
                <form class="col s12" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row">
                        <div class="input-field col s6" >
                            <input id="first_name" type="text" class="validate" name="first_name">
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="last_name" type="text" class="validate" name="last_name">
                            <label for="last_name">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" >
                            <input id="password" type="password" class="validate" name="password">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email">
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
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sec_ecommerce";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "INSERT INTO CUSTOMERS (fname, lname, email, address, phone, password_hash, is_verified, verification_code) 
            VALUES ('$fname', '$lname', '$email', '1 Test Street', 0393002312, '$pwd', 0, 'insert_code_here')";
        $conn->query($sql);

        ?>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
