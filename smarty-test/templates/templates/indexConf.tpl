<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
{* display color and hello data *}
{$color} {$hello}

</br>

{html_select_date display_days=no}

<SELECT name=company>
    {html_options values=$vals selected=$selected output=$output}
</SELECT>


</body>
</html>