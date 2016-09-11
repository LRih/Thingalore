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

                <div class="col s12 m6">
                    <h4>Mountain Lake</h4>

                    <div class="section">
                        <img id="detail-image" class="materialboxed" src="images/products/test1.jpg">
                    </div>

                    <div class="section">
                        <h5>Description</h5>
                        <div class="divider"></div>
                        <p>Standard size lake filled with water. Mountain not included.</p>
                    </div>
                </div>

                <div id="detail-options" class="col s12 m3 center-align">
                    <div id="detail-price" class="red-text">$3.50</div>
                    <a class="waves-effect waves-light btn-flat orange white-text"><i class="material-icons left">add</i>Add to cart</a>
                </div>
            </div>
        </main>

        <?php include_once("templates/footer.php") ?>
    </body>
</html>
 