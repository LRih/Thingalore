<?php

require_once("php/global.php");

// when no id set, redirect to products page
if (!isset($_GET["id"]))
    redirect("index.php");

$p = SQL::getProduct($_GET["id"]);

// error or invalid id
if (is_null($p))
    redirect("index.php");

// get other products by the same manufacturer
$moreProducts = SQL::getProductsByManufacturer($p->manufacturer, $p->id);

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require_once("templates/head.php") ?>
        <title><?php echo $p->name ?> | <?php echo $TITLE ?></title>
    </head>

    <body>
        <?php require_once("templates/nav.php") ?>

        <main id="main">
            <div class="row">
                <div class="col s12 m3">
                    <?php require_once("templates/side-nav.php"); createSideNav("Products", "") ?>
                </div>

                <div class="col s12 m6">
                    <h5><?php echo $p->name ?></h5>

                    <div class="section">
                        <img id="detail-image" class="materialboxed" src="images/products/<?php echo $p->image ?>">
                    </div>

                    <div class="section">
                        <h5>Description</h5>
                        <div class="divider"></div>
                        <?php echo $p->formattedDesc() ?>
                    </div>

                    <?php
                        // show more products by manufacturer
                        if (count($moreProducts) > 0)
                        {
                            echo "<div class='header'>";
                            echo "    More from ".$p->manufacturer;
                            echo "</div>";

                            foreach ($moreProducts as $p)
                            {
                                echo "<a href='product-detail.php?id=".$p->id."'>";
                                echo "    <div class='more-image-container' style='background-image:url(\"images/products/".$p->image."\")'>";
                                echo "    </div>";
                                echo "</a>";
                            }
                        }
                    ?>
                </div>

                <div class="col s12 m3">
                    <div id="detail-options" class="center-align">
                        <div id="detail-price" class="red-text"><?php echo $p->formattedPrice() ?></div>
                        <?php
                            if ($p->price != NULL)
                                echo "<div id='retail-price' class='grey-text text-darken-1'>".$p->formattedRRP()."</div>";
                        ?>

                        <form id="add-to-cart-form" method="get" action="actions/add-to-cart.php">
                            <input type="hidden" name="id" value="<?php echo $p->id ?>" />
                            <button class="btn waves-effect waves-light btn-flat orange white-text" type="submit"><i class="material-icons left">add</i>Add to cart</button>
                        </form>
                    </div>

                    <div class="container section">
                        <strong>Manufacturer</strong>
                        <div class="divider"></div>
                        <?php echo $p->manufacturer != NULL ? $p->manufacturer : "Unknown" ?>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once("templates/footer.php") ?>
    </body>
</html>
 