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


//$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
//    $r->addRoute('GET', '/users', 'get_all_users_handler');
//    // {id} 必须是一个数字 (\d+)
//    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
//    //  /{title} 后缀是可选的
//    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
//});
//
//// 获取请求的方法和 URI
//$httpMethod = $_SERVER['REQUEST_METHOD'];
//$uri = $_SERVER['REQUEST_URI'];
//
//// 去除查询字符串( ? 后面的内容) 和 解码 URI
//if (false !== $pos = strpos($uri, '?')) {
//    $uri = substr($uri, 0, $pos);
//}
//$uri = rawurldecode($uri);
//
//$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
//switch ($routeInfo[0]) {
//    case FastRoute\Dispatcher::NOT_FOUND:
//        // ... 404 Not Found 没找到对应的方法
//        break;
//    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
//        $allowedMethods = $routeInfo[1];
//        // ... 405 Method Not Allowed  方法不允许
//        break;
//    case FastRoute\Dispatcher::FOUND: // 找到对应的方法
//        $handler = $routeInfo[1]; // 获得处理函数
//        $vars = $routeInfo[2]; // 获取请求参数
//        // ... call $handler with $vars // 调用处理函数
//        break;
//}