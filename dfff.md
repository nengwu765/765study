<?php
/**
 * Created by PhpStorm.
 * User: nwqian
 * Date: 16-1-4
 * Time: 下午1:18
 */

$userFavor = ['军情', '汽车', '理财', '房产', '生活', '购物', '视频', '旅游'];
$adCache = [
    [
        'id' => 1,
        'category' => '房产',
    ],
    [
        'id' => 2,
        'category' => '汽车',
    ],
    [
        'id' => 3,
        'category' => '军情',
    ],
    [
        'id' => 4,
        'category' => '旅游',
    ],
    [
        'id' => 5,
        'category' => '军情',
    ],
    [
        'id' => 6,
        'category' => '购物',
    ],
];
var_dump('==============', $userFavor, '=============', $adCache);
usort($adCache, function ($a, $b) use ($userFavor) {
    $idxA = array_search($a['category'], $userFavor);
    $idxB = array_search($b['category'], $userFavor);
    return $idxA > $idxB;
});
var_dump('=============', $adCache);
