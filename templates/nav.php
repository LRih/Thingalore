<div id="banner-container" class="orange darken-4">
    <div id="banner" class="valign-wrapper">
        <div class="white-text valign">
            <a class="white-text left" href="index.php"><img class="valign" src="images/title.png"></a>
            <form class="right hide-on-small-only" method="get" action="index.php">
                <input id="search-box" class="grey-text text-darken-2 vert-align tooltipped" data-tooltip="I don't work" name="search" type="text" placeholder="search"><button id="search-btn" class="btn waves-effect waves-light btn-flat orange darken-1 white-text vert-align" type="submit"><i class="material-icons">search</i></button>
            </form>
        </div>
    </div>

    <div id="nav" class=" darken-1 right-align">
        <a href="index.php" class="waves-effect waves-light white-text nav-btn left"><i class="material-icons left">home</i>Home</a>
        <a href="user-profile.php" class="waves-effect waves-light white-text nav-btn left"><i class="material-icons left">perm_identity</i>Temp Profile</a>

        <a href="cart.php" class="waves-effect waves-light white-text nav-btn">
            <i class="material-icons left">shopping_cart</i>
            <?php
                echo "Cart";

                // show cart count
                if (isset($_SESSION["cart"]) && $_SESSION["cart"]->qty() > 0)
                    echo " <span id='cart-count' class='blue darken-2'>".$_SESSION["cart"]->qty()."</span>";
            ?>
        </a>
        <a href="login.php" class="waves-effect waves-light white-text nav-btn"><i class="material-icons left">account_circle</i>Account</a>
    </div>
</div>