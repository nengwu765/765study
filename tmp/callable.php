<?php

function testCallable (callable $callback = null)
{
    $result = is_null($callback);
    return $result;
}

$test = testCallable();
var_dump($test);