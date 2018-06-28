<?php

$server = new swoole_http_server("0.0.0.0", 9503);

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

$server->on('request', function ($request, $response) {
    var_dump($request->get);
    $response->header("Content-Type", "text/html; charset=utf-8");
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
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