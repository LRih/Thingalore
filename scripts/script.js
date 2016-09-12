
/* Runs on page load */
$(function()
{
    // to get the navigation drawer to work
    $(".button-collapse").sideNav();
});

function onOkClick()
{
    $("#main-card").animate({ "opacity": 0, "margin-top": 0 }, 300); 
}