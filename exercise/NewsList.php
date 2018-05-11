<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <title>Insert title here</title>
</head>
<body>

<br/>
<table cellspacing="0" cellpadding="0" align="center" bgcolor="#ccc" width=500 >
    <a href="NewsPublish.html" style="padding:20px 30px">发布文章</a>
    <tr>
        <th>编号</th>
        <th>文章标题</th>
        <th>发布时间</th>
        <th>操作</th>
    </tr>
    <?php
    require_once 'ConnectDB.php';

    $sql="select id,url,title from news where status = 1 order by id desc";
    $stmt=$pdo->prepare($sql);//这就是我们所说的预处理
    $stmt->execute();//执行预处理的结果;
    $newsList=$stmt->fetchall(PDO::FETCH_ASSOC);//将返回的结果集以数组的方式全部返回给变量$jg
    $pdo = null; //关闭数据库链接

    foreach ($newsList as $news):
        ?>
        <tr>
            <td align="center" style="border:1px solid #000"><?php echo $news['id'];?></td>
            <input type="hidden" name="id" value="<?php echo $news['id'];?>"/>
            <td align="center" style="border:1px solid #000">
                <?php if($news['url']):?>
                    <a href="<?php echo $news['url'];?>"><?php echo $news['title'];?></a>
                <?php else:?>
                    <?php echo $news['title'];?>
                <?php endif;?>
            </td>
            <td align="center" style="border:1px solid #000"><?php echo $news['published_time'];?></td>
            <td align="center" style="border:1px solid #000">
                <a href="NewsEdit.php?id=<?php echo $news['id']?>"><font color="red">修改</font></a>
                <a href="NewsDelete.php?id=<?php echo $news['id']?>"><font color="red">删除</font></a>
            </td>
        </tr>
        <?php
        endforeach;
    ?>
</table>
</body>
</html>