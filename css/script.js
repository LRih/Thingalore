
/* Go to specified URL */
function navigate(url)
{
    window.document.location = url;
}

/* Password strength functions */
function getPasswordColor(val)
{
    var str = getPasswordStrength(val);

    // determine color based on steps
    if (str > 75)
        return "#8bc34a"; // green
    else if (str > 50)
        return "#ffeb3b"; // yellow
    else if (str > 25)
        return "#ffa500"; // orange

    return "#f44336"; // red
}

function getPasswordStrength(val)
{
    return Math.min(Math.max(val.length * 10, 1), 100);
}
