<?php

require_once("php/global.php");

function getPageUrl($page)
{
    $args = array("page" => $page);
    if (isset($_GET["category"]))
        $args["category"] = $_GET["category"];
    if (isset($_GET["search"]))
        $args["search"] = $_GET["search"];

    return $_SERVER['PHP_SELF']."?".http_build_query($args);
}


$products = [];

// TODO limit max number of pages to show in pagination list
// TODO in future, only get as required for current page

// search takes precedence over category
if (isset($_GET["search"]))
{
    // check for empty search query
    if (empty($_GET["search"]))
        redirect("index.php");

    $products = SQL::getProductsLikeName($_GET["search"]);
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

// paginate
if (isset($_GET["page"]) && is_numeric($_GET["page"]))
    $curPage = intval($_GET["page"]);
else
    $curPage = 1;

$pager = new Paginator($curPage, count($products), 9);

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
                        for ($i = $pager->firstItem(); $i < $pager->lastItem(); $i++)
                        {
                            $p = $products[$i];

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
                            <?php
                                // left button
                                if ($pager->showLeft())
                                    echo "<li class='waves-effect'><a href='".getPageUrl($pager->page - 1)."'><i class='material-icons'>chevron_left</i></a></li>";

                                // pages
                                for ($page = 1; $page <= $pager->pageCount(); $page++)
                                {
                                    $active = $pager->page === $page ? "active orange darken-2" : "waves-effect";
                                    $url = getPageUrl($page);

                                    echo "<li class='{$active}'><a href='{$url}'>{$page}</a></li>";
                                }

                                // right button
                                if ($pager->showRight())
                                    echo "<li class='waves-effect'><a href='".getPageUrl($pager->page + 1)."'><i class='material-icons'>chevron_right</i></a></li>";
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
 