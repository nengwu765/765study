<?php

/**
 * 定义swoole程序的退出
 */
if (!function_exists('swoole_exit')) {
    function swoole_exit($msg)
    {
        //php-fpm的环境
        if (ENV=='php')
        {
            exit($msg);
        }
        //swoole的环境
        else
        {
            throw new Swoole\ExitException($msg);
        }
    }
}
