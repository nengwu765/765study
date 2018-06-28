<?php

$server = new Swoole\Server("0.0.0.0", 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

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

//监听数据接收事件
$server->on('Packet', function ($serv, $data, $clientInfo) {
    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server:".$data);
    var_dump($clientInfo);
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