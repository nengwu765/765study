<?php
header("content-type:text/html;charset=utf8");
require_once 'ConnectDB.php';
$id=(int)$_GET['id'];
$sql="update news set status = '$id' where id = '$id'";

$stmt=$pdo->prepare($sql); //预处理
$stmt->execute();//执行预处理的sql语句
$pdo = null; //关闭数据库链接

if ($stmt) {
    $con = '删除成功';
    $url = 'NewsList.php';
    echo"<script type='text/javascript'>alert('".$con."');location.href='".$url."';</script>";
    exit;
} else {
    $con = '删除失败';
    $url = 'NewsList.php';
    echo"<script type='text/javascript'>alert('".$con."');location.href='".$url."';</script>";
    exit;
}