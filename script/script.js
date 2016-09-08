
/* Runs on page load */
$(function()
{
});

function onCoolClick()
{
    $("#main-card").animate({ "font-size": "24px" }, 300); 
}

function onNoClick()
{
    $("#main-card").animate({ "opacity": 0, "margin-top": 0 }, 300); 
}