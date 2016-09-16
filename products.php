<?php

require_once("data/global.php");
require_once("data/sql.php");

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>Products - {category}</title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m3">
                    <?php require_once("templates/side-nav.php"); createSideNav("Products") ?>
                </div>

                <div id="product-container" class="col s12 m9">
                    <?php
                        $products = SQL::getProducts();

                        for ($i = 0; $i < count($products); $i++)
                        {
                            $p = $products[$i];
                            
                            echo "<a class='product' href='product-detail.php?id=".$i."'>";
                            echo "    <div class='product-image-container'>";
                            echo "        <img class='product-image' src='images/products/".$i.".jpg'>";
                            echo "    </div>";
                            echo "    <div class='product-text'>";
                            echo "        <div class='product-name'>".$p["name"]."</div>";
                            echo "        <div class='product-price red-text right-align'>$".number_format($p["price"] / 100, 2, '.', ',')."</div>";
                            echo "    </div>";
                            echo "</a>";
                        }
                    ?>

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

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
 