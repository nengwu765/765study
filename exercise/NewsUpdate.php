<?php
header("content-type:text/html;charset=utf8");
$arr=$_POST;
$id=(int)$arr['id'];
require_once 'ConnectDB.php';
$sql="update news set title = '$arr[title]',content = '$arr[content]' where id = '$id'";

$stmt=$pdo->prepare($sql); //预处理
$stmt->execute();//执行预处理的sql语句
$pdo = null; //关闭数据库链接

if ($stmt) {
    $con = '修改成功';
    $url = 'NewsList.php';
    echo"<script type='text/javascript'>alert('".$con."');location.href='".$url."';</script>";
    exit;
} else {
    $con = '修改失败';
    $url = 'NewsList.php';
    echo"<script type='text/javascript'>alert('".$con."');location.href='".$url."';</script>";
    exit;
}
