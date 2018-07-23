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