<?php

if (!function_exists('load_config_file'))
{
    function load_config_file($file = "common")
    {
        global $G_CONF_PATH;
        $path_confs = $G_CONF_PATH;

        $config = [];
        foreach($path_confs as $path) {
            $fullPath = "$path$file.php";
            if(file_exists($fullPath)) {
                include $fullPath;
            }
        }
        return $config;
    }
}

/**
 * 获取文件配置，使用点语法获取
 *
 * @example config('redis.local')
 */
if (!function_exists('config')) {
    function config(string $key, $default = null)
    {
        $parts = explode('.', $key);
        $count = count($parts);

        // TODO 待优化
        if ($count > 0 ) {
            $base = load_config_file($parts[0]);
            unset($parts[0]);
            while ($key = array_shift($parts)){
                if(isset($base[$key])){
                    $config = $base[$key];
                }else{
                    return $default;
                }
            }
            return $config;
        } else {
            throw new InvalidArgumentException('Invalid key: ' . $key);
        }
    }
}

/**
 * @return bool
 */
function is_debug_enabled()
{
    return true;
}

/**
 * @return string
 */
function debug_log_path()
{
    $logPath = APP_PATH . 'logs/debug';
    if (is_dir($logPath)) {
        mkdir($logPath, 0777, true);
    }
    return APP_PATH . 'logs/debug/debug-' . date('Ymd') . '.log';
}

/**
 * @param string $message //调试信息
 * @param mixed $context // 调试内容体
 * @return void
 */
function my_debug($message, $context)
{
    if (!(is_debug_enabled()))
    {
        return;
    }

    $output = [];
    $output[] = str_repeat('*', 100);

    // 获取当前进程ID，可以唯一标示一个进程内产生的日志，便于日志的查看和对应
    $output[] = date('* Y-m-d H:i:s') . ', PHP process ID:' . posix_getpid();
    $output[] = str_repeat('*', 100);
    $output[] = $message . PHP_EOL;
    if (is_array($context))
    {
        $output[] = var_export($context, true);
    }
    else
    {
        $output[] = $context;
    }
    $output[] = str_repeat('-', 100);
    $output[] = str_repeat('-', 100);
    $output[] = PHP_EOL;

    file_put_contents(debug_log_path(), implode(PHP_EOL, $output), FILE_APPEND);
}