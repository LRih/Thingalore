<?php

require_once("php/sql.php");

function createSideNav($selected)
{
    // navigation links
    $links = array(
        "Home" => "index.php",
        "Products" => "products.php",
        "FAQs" => "faqs.php",
        "Contact" => "contact.php"
    );

    // add navigation
    echo "<div class='collection'>";

    foreach ($links as $name => $url)
    {
        // highlight current page
        $cls = $selected === $name ? "red lighten-1 white-text" : "red-text text-lighten-1";
        echo "<a href='{$url}' class='collection-item {$cls}'>{$name}</a>";

        // if product page selected, show categories under products
        if ($selected === "Products" && $name === "Products")
            createCategories();
    }

    echo "</div>";
}

function createCategories()
{
    $categories = SQL::getCategories();

    for ($i = 0; $i < count($categories); $i++)
    {
        // if last item, use special class to show a bottom border
        $cls = $i == count($categories) - 1 ? "last" : "";

        $name = $categories[$i];
        $lname = strtolower($name);
        
        echo "<a href='products.php?category={$lname}' class='category {$cls}'>{$name}</a>";
    }
}

?>