<!DOCTYPE html>

<html>
    <head>
        <?php include_once("templates/head.php") ?>
        <title>Title</title>
    </head>

    <body>
        <?php include_once("templates/nav.php") ?>

        <main id="main">
            <div class="container row">
                <div class="col s12 m3">
                    <?php include_once("templates/side-nav.php") ?>
                </div>

                <div id="product-container" class="col s12 m9">
                    <a class="product" href="product-detail.php">
                        <div class="product-image-container">
                            <img class="product-image" src="images/products/test1.jpg">
                        </div>
                        <div class="product-text">
                            <div class="product-name">Mountain Lake</div>
                            <div class="product-price red-text right-align">$3.50</div>
                        </div>
                    </a>
                    <a class="product" href="#">
                        <div class="product-image-container">
                            <img class="product-image" src="images/products/test2.jpg">
                        </div>
                        <div class="product-text">
                            <div class="product-name">Pine Tree</div>
                            <div class="product-price red-text right-align">$4.50</div>
                        </div>
                    </a>
                    <a class="product" href="#">
                        <div class="product-image-container">
                            <img class="product-image" src="images/products/test3.jpg">
                        </div>
                        <div class="product-text">
                            <div class="product-name">Pier</div>
                            <div class="product-price red-text right-align">$9.95</div>
                        </div>
                    </a>
                    <a class="product" href="#">
                        <div class="product-image-container">
                            <img class="product-image" src="images/products/test4.jpg">
                        </div>
                        <div class="product-text">
                            <div class="product-name">Pencil</div>
                            <div class="product-price red-text right-align">$14.00</div>
                        </div>
                    </a>

                    <div class="center-align">
                        <ul class="pagination">
                            <li class="disabled"><a href="#"><i class="material-icons">chevron_left</i></a></li>
                            <li class="active red lighten-1"><a href="#">1</a></li>
                            <li class="waves-effect"><a href="#">2</a></li>
                            <li class="waves-effect"><a href="#"><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once("templates/footer.php") ?>
    </body>
</html>
 