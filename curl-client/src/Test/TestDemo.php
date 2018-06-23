<?php

namespace My\Client\Test;

use \Curl\Curl;

class TestDemo
{
    public static function test()
    {
        $curl = new Curl();
        $curl->get('https://www.example.com/');

        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            echo 'Response:' . "\n";
            var_dump($curl->response);
        }
    }
}