<?php

////线下
//$dsn = "mysql:host=172.17.20.119;dbname=cheat_star";
//$db_user = 'dev';
//$db_pass = 'dev_pass';

// 线上
$dsn = "mysql:host=172.16.16.112;dbname=cheat_star";
$db_user = 'cheat_star';
$db_pass = 'eO9KefmyNgwDje0l7fKO';

try{
    $pdo = new PDO($dsn, $db_user, $db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
    exit;
}

ini_set('memory_limit', '512M');
$allIds = ["59956"];
//$allIds = ["22757","22758","22759","22760","22761","22762","22763",];

echo '共有ID数为' . count($allIds) . PHP_EOL;

/**
 * @param PDO $pdo pdo
 * @param array $ids ids
 * @return void
 */
function dofunction($pdo, $ids, &$i)
{
    $upIdsStr = implode(',', $ids);
    //修改
    $sql = "update black_passid_product set status = 2 where id in ({$upIdsStr})";
    $res = $pdo->exec($sql);
    $i++;
    echo "第{$i}次运行--影响行数：".$res  . PHP_EOL;
}

$i = 0;

$upIds = [];
foreach ($allIds as $id)
{
    $upIds[] = $id;

    if (count($upIds) == 100)
    {
        dofunction($pdo, $upIds, $i);
        $upIds = [];
    }
}

if ($upIds)
{
    dofunction($pdo, $upIds, $i);
    $upIds = [];
}


