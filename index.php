<?php

require_once("php/global.php");

// check if category is valid
if (isset($_GET["category"]) && !SQL::isCategoryValid($_GET["category"]))
{
    header('Location: index.php');
    die;
}

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>
            <?php
                if (isset($_GET["category"]))
                    echo $_GET["category"]." | ";

                echo $TITLE;
            ?>
        </title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m3">
                    <?php require_once("templates/side-nav.php"); createSideNav("Products") ?>
                </div>

                <div id="product-container" class="col s12 m9">
                    <div class='header'>
                        <?php
                            // only show new products header when category is not selected
                            echo isset($_GET["category"]) ? strtoupper($_GET["category"]) : "NEW PRODUCTS";
                        ?>
                    </div>

                    <?php
                        $products = isset($_GET["category"]) ? SQL::getProductsByCategory($_GET["category"]) : SQL::getProducts();

                        foreach ($products as $p)
                        {
                            echo "<a class='product z-depth-1' href='product-detail.php?id=".$p->id."'>";
                            echo "    <div class='product-image-container'>";
                            echo "        <img class='product-image' src='images/products/".$p->image."'>";
                            echo "    </div>";
                            echo "    <div class='product-text'>";
                            echo "        <div class='product-name'>".$p->name."</div>";
                            echo "        <div class='product-price red-text right-align'>$".$p->formattedPrice()."</div>";
                            echo "    </div>";
                            echo "</a>";
                        }
                    ?>

                    <div class="center-align">
                        <ul class="pagination">
                            <li class="disabled"><a href="#"><i class="material-icons">chevron_left</i></a></li>
                            <li class="active red lighten-1"><a href="<?php echo $_SERVER['REQUEST_URI'] ?>">1</a></li>
                            <li class="disabled"><a href="#"><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
 