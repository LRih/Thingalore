<?php

require_once("php/sql.php");

function createSideNav($selectedTab, $selectedCategory)
{
    // navigation links
    $links = array(
        "Products" => "index.php",
        "FAQs" => "faqs.php",
        "Contact" => "contact.php"
    );

    // add navigation
    echo "<div class='collection'>";

    foreach ($links as $name => $url)
    {
        // highlight current page
        $cls = $selectedTab === $name ? "red lighten-1 white-text" : "red-text text-lighten-1";
        echo "<a href='{$url}' class='collection-item {$cls}'>{$name}</a>";

        // show categories under products
        if ($name === "Products")
            createCategories($selectedCategory);
    }

    echo "</div>";
}

function createCategories($selectedCategory)
{
    $categories = SQL::getCategories();

    for ($i = 0; $i < count($categories); $i++)
    {
        $name = $categories[$i];
        $lname = strtolower($name);

        $active = $selectedCategory === $lname ? "red-text text-lighten-1" : ""; // show selected category in red
        $last = $i == count($categories) - 1 ? "last" : ""; // if last item, use special class to show a bottom border
        
        echo "<a href='index.php?category={$lname}' class='category {$active} {$last}'>{$name}</a>";
    }
}

?>