<?php

$redisClient = new Redis();

$redisClient->connect('127.0.0.1', 6379);

echo $redisClient->get('key') . PHP_EOL;

var_export($redisClient->hGetAll('car'));