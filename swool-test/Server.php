<?php

$server = new Swoole\Server("0.0.0.0", 9501);

$server->set([
    'worker_num' => 1,
    'task_worker_num' => 1,
]);

$callbacks = [];

$callbacks[] = function () {
    echo 1;
};

$callbacks[] = function () {
    echo 2;
};



$server->on('start', function ($serv) {
    swoole_set_process_name("[Swoole Master{$serv->master_pid}]");
    echo "start\n";
});


$server->on('managerStart', function ($serv) {
    swoole_set_process_name("[Swoole Manager{$serv->manager_pid}]");
    echo "manager\n";
});

//$server->on('workerStart', function ($serv, $worker_id) {
//
//    if($serv->taskworker) {
//        swoole_set_process_name("[Swoole Task{$worker_id}-{$serv->worker_pid}]");
//        echo "task\n";
//    } else {
//        swoole_set_process_name("[Swoole Work{$worker_id}-{$serv->worker_pid}]");
//        echo "work\n";
//    }
//});

$server->on('workerStart', $callbacks);

$server->on('receive', function ($serv, $fd, $from_id, $data) {
//    // 设置定时器，并获得定时器ID，以便在程序close时进行关闭
//    $serv->stId = swoole_timer_tick(2000, function () use ($serv, $fd, $from_id, $data) {
//        $serv->send($fd, 'Server:'.$data);
//    });
    $taskId = $serv->task($data);
    echo "Dispath AsyncTask: id=$taskId\n";

    echo "receive\n";
});

$server->on('task', function ($serv, $task_id, $from_id, $data) {
    echo "New AsyncTask[id=$task_id]".PHP_EOL;
    //返回任务执行的结果
    $serv->finish("$data -> OK");
    echo "task done\n";
});


$server->on('finish', function ($serv, $task_id, $data) {
    echo "task finish $data\n";
});


$server->on('connect', function () {

    echo "connect\n";
});

$server->on('close', function ($serv, $fd, $reactorId) {
//    // 获取定时器，并在此进行关闭
//    echo $serv->stId;
//    swoole_timer_clear($serv->stId);
    echo "close\n";
});

$server->start();