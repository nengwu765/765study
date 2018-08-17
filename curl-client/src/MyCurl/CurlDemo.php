<?php

namespace My\Client\MyCurl;

use \Curl\Curl;
use Curl\MultiCurl;

class CurlDemo
{
    public function getCurl()
    {
        try {
            $curl = new Curl();
            $curl->get('https://www.baidu.com/');

            if ($curl->error) {
                echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
            } else {
                echo 'Response:' . "\n";
                var_dump($curl->response);
            }
        } catch (\Throwable $e) {
            var_dump($e->getMessage());
            exit;
        }

    }

    public function multiCurl()
    {
        try {
            $multi_curl = new MultiCurl();

            $multi_curl->success(function ($instance) {
                /**@var Curl $instance*/
                echo 'call to "' . $instance->url . '" was successful.' . "\n";
                //echo 'response: ' . $instance->response . "\n";
                echo 'error: ' . $instance->error . "\n";
                echo 'error: ' . $instance->httpStatusCode . "\n";

            });
            $multi_curl->addGet('https://www.baidu.com/');
            $multi_curl->addGet('https://baidu.com/');
            $multi_curl->addPost('http://cheatmanage.xqprevention.com/home.php/api/opaccount/');
//            $multi_curl->addGet('https://www.bing.com/search', array(
//                'q' => 'hello world',
//            ));
            $multi_curl->start();
            //$multi_curl->
        } catch (\Throwable $e) {
            var_dump($e->getMessage());
            exit;
        }
    }
}