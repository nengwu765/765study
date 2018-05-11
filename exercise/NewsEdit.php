<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <title>Insert title here</title>
</head>
<body bgcolor="#ccc">
<?php
$id=(int)$_GET['id'];
require_once 'ConnectDB.php';
$sql="select id,title,content from news where id = '$id'";
//echo $sql;
$stmt=$pdo->prepare($sql); //预处理
$stmt->execute();//执行预处理的sql语句

$news = $stmt->fetch();
$pdo = null; //关闭数据库链接

?>
<form name="article" method="post" action="NewsUpdate.php" style="margin:5px 500px;">
    <h1>文章发布系统</h1>
    <input type="hidden" name="id" value="<?php echo $news['id']?>"/><br/>
    标题:<input type="text" name="title" value="<?php echo $news['title']?>"/><br/>
    内容:<textarea cols=30 rows=5 name="content"><?php echo $news['content']?></textarea><br/><br/>
    <input type="submit" value="修改文章"/>
    <a href="NewsList.php">返回文章列表</a>
    <a href="NewsPublish.html">返回发布文章</a>
</form>
</body>
</html>