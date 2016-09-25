<?php

require_once("php/global.php");

$products = [];

// search takes precedence over category
if (isset($_GET["search"]))
{
    // check for empty search query
    if (empty($_GET["search"]))
        redirect("index.php");

    $products = SQL::getProductsBySearch(htmlspecialchars($_GET["search"]));
}
else if (isset($_GET["category"]))
{
    // check if category is valid
    if (!SQL::isCategoryValid($_GET["category"]))
        redirect("index.php");

    $products = SQL::getProductsByCategory($_GET["category"]);
}
else
    $products = SQL::getProducts();

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title>
            <?php
                if (isset($_GET["search"]))
                    echo "Search results | ";
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
                    <?php
                        require_once("templates/side-nav.php");
                        createSideNav("Products", isset($_GET["category"]) ? $_GET["category"] : "");
                    ?>
                </div>

                <div id="product-container" class="col s12 m9">
                    <div class='header'>
                        <?php
                            // header depends on viewing mode
                            if (isset($_GET["search"]))
                                echo "Search results for <strong>".htmlspecialchars($_GET["search"])."</strong>";
                            else if (isset($_GET["category"]))
                                echo strtoupper($_GET["category"]);
                            else
                                echo "NEW PRODUCTS";
                        ?>
                    </div>

                    <?php
                        foreach ($products as $p)
                        {
                            echo "<a class='product z-depth-1 hoverable' href='product-detail.php?id=".$p->id."'>";
                            echo "    <div class='product-image-container' style='background-image:url(\"images/products/".$p->image."\")'>";
                            echo "    </div>";
                            echo "    <div class='product-text'>";
                            echo "        <div class='product-name'>".$p->name."</div>";

                            // create discounted label
                            $discountLabel = "";

                            if ($p->price != NULL)
                                $discountLabel = "<span class='discount-label grey-text text-darken-1 vert-align'>".$p->discountPercent()."% OFF</span>";

                            echo "        <div class='product-price red-text right-align'>".$discountLabel.$p->formattedPrice()."</div>";
                            echo "    </div>";
                            echo "</a>";
                        }
                    ?>

                    <div class="center-align">
                        <ul class="pagination">
                            <li class="disabled"><a><i class="material-icons">chevron_left</i></a></li>
                            <li class="active orange darken-2"><a href="<?php echo $_SERVER['REQUEST_URI'] ?>">1</a></li>
                            <li class="disabled"><a><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
 