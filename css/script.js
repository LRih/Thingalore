
$(document).ready(function()
{
    var dur = 50;
    var inputs = $('.input-field input');

    // show existing tooltip when input gets focused
    inputs.focus(function()
    {
        $(this).siblings(".tooltip").animate({ opacity: 1 }, dur);
    });

    // hide existing tooltip when input loses focus
    inputs.blur(function()
    {
        $(this).siblings(".tooltip").animate({ opacity: 0 }, dur);
    });
});

/* Go to specified URL */
function navigate(url)
{
    window.document.location = url;
}
