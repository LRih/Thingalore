<?php

require_once("php/global.php");

$maxOnPage = 9;
$products = [];

// TODO limit max number of pages to show in pagination list
// TODO in future, only get as required for current page

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

// paginate
$pages = ceil(count($products) / $maxOnPage);

if (isset($_GET["page"]) && is_numeric($_GET["page"]))
{
    $curPage = intval($_GET["page"]);
    $curPage = intval(min(max($curPage, 1), $pages)); // limit to page bounds
}
else
    $curPage = 1;

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
                        $start = ($curPage - 1) * $maxOnPage;
                        $end = min($curPage * $maxOnPage, count($products));

                        for ($i = $start; $i < $end; $i++)
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
                                $leftActive = $curPage > 1 ? "waves-effect" : "disabled";
                                $leftUrl = $curPage > 1 ? "href='".getPageUrl($curPage - 1)."'" : "";
                                echo "<li class='{$leftActive}'><a {$leftUrl}><i class='material-icons'>chevron_left</i></a></li>";

                                // pages
                                for ($i = 0; $i < $pages; $i++)
                                {
                                    $page = $i + 1;
                                    $active = $curPage === $page ? "active orange darken-2" : "waves-effect";
                                    $url = getPageUrl($page);

                                    echo "<li class='{$active}'><a href='{$url}'>{$page}</a></li>";
                                }

                                // right button
                                $rightActive = $curPage < $pages ? "waves-effect" : "disabled";
                                $rightUrl = $curPage < $pages ? "href='".getPageUrl($curPage + 1)."'" : "#";
                                echo "<li class='{$rightActive}'><a {$rightUrl}><i class='material-icons'>chevron_right</i></a></li>";

                                function getPageUrl($page)
                                {
                                    $args = array("page" => $page);
                                    if (isset($_GET["category"]))
                                        $args["category"] = $_GET["category"];
                                    if (isset($_GET["search"]))
                                        $args["search"] = $_GET["search"];

                                    return $_SERVER['PHP_SELF']."?".http_build_query($args);
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
 