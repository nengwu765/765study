<?php

$serv = new \swoole_http_server("127.0.0.1", 9503, SWOOLE_BASE);

$serv->on('request', function ($req, $resp) {
    $chan = new chan(2);
    go(function () use ($chan) {
//        $cli = new Swoole\Coroutine\Http\Client('www.baidu.com', 80);
//        $cli->set(['timeout' => 10]);
//        $cli->setHeaders([
//            'Host' => "www.baidu.com",
//            "User-Agent" => 'Chrome/49.0.2587.3',
//            'Accept' => 'text/html,application/xhtml+xml,application/xml',
//            'Accept-Encoding' => 'gzip',
//        ]);
//        $cli->get('/');
        $chan->push(['www.qq.com' => 'yyyyyy']);
    });

    go(function () use ($chan) {
//        $cli = new Swoole\Coroutine\Http\Client('www.qq.com', 80);
//        $cli->set(['timeout' => 10]);
//        $cli->setHeaders([
//            'Host' => "www.163.com",
//            "User-Agent" => 'Chrome/49.0.2587.3',
//            'Accept' => 'text/html,application/xhtml+xml,application/xml',
//            'Accept-Encoding' => 'gzip',
//        ]);
//        $cli->get('/');
        $chan->push(['www.163.com' => 'oooooo']);
    });

    $result = [];
    for ($i = 0; $i < 2; $i++)
    {
        $result += $chan->pop();
    }
    $resp->end(json_encode($result));
});
$serv->start();