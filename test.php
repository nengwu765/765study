<?php
/**
 * Created by PhpStorm.
 * User: nwqian
 * Date: 16-1-4
 * Time: 下午1:18
 */


$a = [];
array_unshift($a, ['33','44']);
var_dump($a);exit;

$time = time();
$str = "SECRETPHONEA".$time.'293';
echo $time.PHP_EOL;
echo md5($str).PHP_EOL;

echo 60*60*1.5;

$data = array(
    'prop_id'=>1 ,
    'city_id'=>1,
    'flag' =>1, //房源新增-1 房源/小区/区域板块更新-2
    'update_time' => time(),
    'from_type'=>111, //房源新增/更新-111 小区/区域板块变更-112
);
echo json_encode($data);
