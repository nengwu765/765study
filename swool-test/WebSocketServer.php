<?php

$server = new swoole_websocket_server("0.0.0.0", 9504);

$server->set([
    'worker_num' => 1,
    'task_worker_num' => 1,
]);

$server->on('start', function ($serv) {
    swoole_set_process_name("[Swoole Master{$serv->master_pid}]");
    echo "start\n";
});


$server->on('managerStart', function ($serv) {
    swoole_set_process_name("[Swoole Manager{$serv->manager_pid}]");
    echo "manager\n";
});

$server->on('workerStart', function ($serv, $worker_id) {
    if($serv->taskworker) {
        swoole_set_process_name("[Swoole Task{$worker_id}-{$serv->worker_pid}]");
        echo "task\n";
    } else {
        swoole_set_process_name("[Swoole Work{$worker_id}-{$serv->worker_pid}]");
        echo "work\n";
    }
});

//监听WebSocket连接打开事件
$server->on('open', function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "hello, welcome\n");
});

//监听WebSocket消息事件
$server->on('message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "server: {$frame->data}");
});

$server->on('task', function ($serv, $task_id) {
    echo "task done\n";
});


$server->on('finish', function ($serv, $task_id) {
    echo "task finish\n";
});


$server->on('close', function () {

    echo "close\n";
});

$server->start();