<?php
/* Smarty version 3.1.32, created on 2018-05-11 03:39:56
  from '/home/nwqian/Nwqian/www/smarty-test/templates/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5af5108c54fdf1_75413085',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fb6c00dd060838453fbef38e67e44fd4e1902c34' => 
    array (
      0 => '/home/nwqian/Nwqian/www/smarty-test/templates/templates/index.tpl',
      1 => 1526009994,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af5108c54fdf1_75413085 (Smarty_Internal_Template $_smarty_tpl) {
?>                                

<?php
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "foo.conf", null, 0);
?>

<html>
<title><?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'pageTitle');?>
</title>
<body bgcolor="<?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'bodyBgColor');?>
">
<table border="<?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'tableBorderSize');?>
" bgcolor="<?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'tableBgColor');?>
">
    <tr bgcolor="<?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'rowBgColor');?>
">
        <td>First</td>
        <td>Last</td>
        <td>Address</td>
    </tr>
</table>
</body>
</html>
<?php }
}
