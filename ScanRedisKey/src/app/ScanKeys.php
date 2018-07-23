<?php

namespace Components\ScanRedisKey;

use FastRoute\DataGenerator\GroupCountBased as DataGroupCountBased;
use FastRoute\Dispatcher\GroupCountBased;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;

class ScanKeys
{
    public function scan()
    {
        $redisConnections = config('redis.connections');

        // 此部分将后续进行解偶，目前处于demo阶段
        foreach ($redisConnections as $conKey => $conConf) {
            // db和key规则注册
            $dispatch = $this->registerKeyRules($conKey);

            $redis = new \Redis();
            $redis->pconnect($conConf['host'], $conConf['port']);
            $redis->auth("rc_redis");
            $dbs = $this->findRedisDb($redis);
            foreach ($dbs as $db)
            {
                $redis->select($db);
                foreach ($this->iterator($redis) as $item) {
                    $routeInfo = $dispatch->dispatch('db' . $db, $item);
                    if($routeInfo !== false){
                        switch ($routeInfo[0]) {
                            case \FastRoute\Dispatcher::NOT_FOUND: {
                                $message = 'not found';
                                break;
                            }
                            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:{
                                $message = 'method not allowed';
                                break;
                            }
                            case \FastRoute\Dispatcher::FOUND:{
                                //$handler = $routeInfo[1];
                                $vars = $routeInfo[2];
                                // 捕获到占位符和捕获组
                                var_dump($vars);
                                $message = 'found';
                                break;
                            }
                            default:{
                                $message = '';
                                break;
                            }
                        }

                        // 后续的邮件报警等功能
                        echo 'db:' . $db . ' key:' . $item . ' scanResult:'. $message . PHP_EOL;
                    }

                }
            }
            $redis->close();
        }
    }

    private function registerKeyRules(string $conKey)
    {
        $dbKeyRules = config('redis.' . $conKey);

        $routerCollector = new RouteCollector(new Std(),new DataGroupCountBased());
        foreach ($dbKeyRules as $db => $rules) {
            foreach ($rules as $key => $rule) {
                $routerCollector->addRoute($db, $rule, 'hit');
            }
        }
        return new GroupCountBased($routerCollector->getData());
    }


    private function findRedisDb(\Redis $redis)
    {
        $dbs = [];
        $info = $redis->info();
        foreach ($info as $key => $item)
        {
            if (preg_match("#^db(?<db>\\d+)$#", $key, $match))
            {
                $dbs[] = $match["db"];
            }
        }
        return $dbs;
    }

    private function iterator(\Redis $redis)
    {
        $it = null;
        while ($keys = $redis->scan($it))
        {
            foreach ($keys as $key)
            {
                yield $key;
            }
        }
    }

}