<?php

namespace Components\ScanRedisKey\config;

// redis连接配置
$config['connections'] = [
    'local' => [
        'host' => '127.0.0.1',
        'port' => '6379',
        'auth' => 'rc_redis',
        //'db' => 0
    ]
];

// redis规则配置
$config['local']['db0'] = [
    'test',
    'test{id:[0-9]+}{subName}',
    'test{id:[0-9]+}:{subName:[a-z]+}',
    'test{id:[0-9]+}',
    'test:{adID:cu[0-9]+}',
];

$config['local']['db1'] = [
    //'testKey',
    'test{ID}',
];


