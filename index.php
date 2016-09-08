<!DOCTYPE html>

<html>
    <head>
        <!-- reCAPTCHA -->
        <script src='https://www.google.com/recaptcha/api.js'></script>

        <!-- JQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

        <!-- Materialize -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <script type="text/javascript" src="script/script.js"></script>
        
        <title>Unnamed Web Store</title>
    </head>

    <body>
        
        <div class="container">
            <div class="row">
                <div class="col s4">
                </div>
                
                <div class="col s4">
                    <div id="main-card" class="card blue-grey darken-1 center-align">
                        <div class="card-content white-text">
                          <span class="card-title">Unnamed Web Store</span>
                          <p>Home of future e-commerce website (if we have enough time to make it).</p>
                        </div>
                        <div class="card-action">
                          <a href="#" onclick="onCoolClick()">Cool</a>
                          <a href="#" onclick="onNoClick()">No</a>
                        </div>
                    </div>
                </div>
                
                <div class="col s4">
                </div>
            </div>

            <div id="captcha">
                <div class="g-recaptcha" data-sitekey="6LedrSkTAAAAAN7BN1Or_fqjzS4ZbQBVGjerKkt9"></div>
            </div>
        </div>

    </body>
</html>
 