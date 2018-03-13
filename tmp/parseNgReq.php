<?php
echo 333;
$s = $_GET['s'];
$s = str_replace('\x','',$s);//先把\x去掉，变成完整的十六进制
$s = preg_replace('/(\w{2})/e',"chr(hexdec('\\1'))",$s);//十六进制转为汉字
echo $s;
?>
