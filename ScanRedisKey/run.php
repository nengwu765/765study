<?php

use Components\ScanRedisKey\ScanKeys;

include("vendor/autoload.php");

define('APP_PATH', realpath(dirname(__FILE__)) . '/');

// 全局配置文件目录
$G_CONF_PATH = array(
   APP_PATH . "config/",
);

$scanKeys = new ScanKeys();
$scanKeys->scan();
