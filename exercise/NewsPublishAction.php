<?php
header("content-type:text/html;charset=utf8");
date_default_timezone_set('Asia/Shanghai');
$title=trim($_POST['title']);
$content=trim($_POST['content']);
$time=date("y-m-d H:i:s");

require_once 'ConnectDB.php';
$sql="insert into news(title,content,published_time) values('$title','$content','$time')";
//echo $sql;
$stmt=$pdo->prepare($sql); //预处理
$stmt->execute();//执行预处理的sql语句
$pdo = null; //关闭数据库链接

if ($stmt) {
    $con = '发布成功';
    $url = 'NewsList.php';
    echo"<script type='text/javascript'>alert('".$con."');location.href='".$url."';</script>";
    exit;
} else {
    $con = '发布失败';
    $url = 'NewsList.php';
    echo"<script type='text/javascript'>alert('".$con."');location.href='".$url."';</script>";
    exit;
}