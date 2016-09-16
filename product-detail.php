<?php

require_once("data/global.php");
require_once("data/sql.php");

// when no valid id set, redirect to products page
if (!isset($_GET["id"]))
{
    header('Location: products.php');
    die;
}

$id = intval($_GET["id"]);
$products = SQL::getProducts();

// out of bounds
if ($id < 0 || $id > count($products))
{
    header('Location: products.php');
    die;
}

$p = $products[$id];

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title><?php echo $p["name"] ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m3">
                    <?php require_once("templates/side-nav.php"); createSideNav("Products") ?>
                </div>

                <div class="col s12 m6">
                    <h4><?php echo $p["name"] ?></h4>

                    <div class="section">
                        <img id="detail-image" class="materialboxed center-align" src="images/products/<?php echo $id ?>.jpg">
                    </div>

                    <div class="section">
                        <h5>Description</h5>
                        <div class="divider"></div>
                        <p><?php echo $p["desc"] ?></p>
                    </div>
                </div>

                <div id="detail-options" class="col s12 m3 center-align">
                    <div id="detail-price" class="red-text">$<?php echo number_format($p["price"] / 100, 2, '.', ',') ?></div>
                    <a class="waves-effect waves-light btn-flat orange white-text"><i class="material-icons left">add</i>Add to cart</a>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
 