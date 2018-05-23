{*{config_load file="foo.conf"}*}
{*<html>*}
{*<title>{#pageTitle#}</title>*}
{*<body bgcolor="{#bodyBgColor#}">*}
{*<table border="{#tableBorderSize#}" bgcolor="{#tableBgColor#}">*}
    {*<tr bgcolor="{#rowBgColor#}">*}
        {*<td>First</td>*}
        {*<td>Last</td>*}
        {*<td>Address</td>*}
    {*</tr>*}
{*</table>*}
{*</body>*}
{*</html>*}


{config_load file="foo.conf"}
<html>
<title>{$smarty.config.pageTitle}</title>
<body bgcolor="{$smarty.config.bodyBgColor}">
<table border="{$smarty.config.tableBorderSize}" bgcolor="{$smarty.config.tableBgColor}">
    <tr bgcolor="{$smarty.config.rowBgColor}">
        <td>First</td>
        <td>Last</td>
        <td>Address</td>
    </tr>
</table>
</body>
</html>
