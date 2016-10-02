<?php

function createSideNav($selectedTab)
{
    // navigation links
    $links = array(
        "Profile" => "user-profile.php",
        "Orders" => "user-orders.php",
        "Password" => "user-password.php",
        "Logout" => "actions/logout.php"
    );

    // add navigation
    echo "<div class='collection'>";

    foreach ($links as $name => $url)
    {
        // highlight current page
        $cls = $selectedTab === $name ? "blue lighten-1 white-text" : "grey-text text-darken-1";
        echo "<a href='{$url}' class='collection-item {$cls}'>{$name}</a>";
    }

    echo "</div>";
}

?>