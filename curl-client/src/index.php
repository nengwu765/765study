<?php
namespace My\Client;

use My\Client\MyCurl\CurlDemo;

require __DIR__ . '/../vendor/autoload.php';

$curl = new CurlDemo();
//$curl->getCurl();
$curl->multiCurl();
