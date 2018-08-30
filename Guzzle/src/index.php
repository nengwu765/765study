<?php

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Promise;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

require __DIR__ . '/../vendor/autoload.php';

// url:http://server.s2sapi.simulation/openiflow/openapi/v3/channel/51830095/index.php

//// ����request����ʱ -- ��֤��Ч��
//$client1 = new Client();
//$request1 = new Request('GET', 'http://mywork.test/index2.php');
//$tt1 = microtime(true);
//try {
//    $response = $client1->send($request1, [
//        'timeout' => 0.1, // 100����
//        'curl' => [ CURLOPT_NOSIGNAL => true ], //���Ǳ�Ҫ�ģ�
//    ]);
//} catch (Exception $e) {
//    var_dump($e->getMessage());
//}
//
//$tt2 = microtime(true);
//var_dump($response->getStatusCode());
//echo ($tt2-$tt1)*1000;exit;

//// ��������,ȷ����������
//try {
//    putenv("GUZZLE_CURL_SELECT_TIMEOUT=1");
//    $client2 = new Client();
//    $promises = [
//        'r2'   => $client2->getAsync(
//            'http://baidu.com',
//            [
//                'timeout' => 0.1, // 100����
//                //'curl' => [ CURLOPT_NOSIGNAL => true ], //���Ǳ�Ҫ�ģ�
//            ]
//        ),
//        'r1' => $client2->getAsync(
//            'http://mywork.test/index2.php',
//            [
//                'timeout' => 0.1, // 100����
//                //'curl' => [ CURLOPT_NOSIGNAL => true ], //���Ǳ�Ҫ�ģ�
//            ]
//        ),
//    ];
//    $t1 = microtime(true);
//    $results = Promise\unwrap($promises);
//
//    var_dump($results['r1']->getBody()->getContents());
//    var_dump($results['r2']->getBody()->getContents());
//
//    $t2 = microtime(true);
//
//    echo ($t2-$t1)*1000;
//} catch (Exception $e) {
//    var_dump($e->getMessage());
//    //var_dump($e->getTraceAsString());
//}

//// ��������,��֪���������� -- ��������
//try {
//    $client3 = new Client();
//    $requests = function ($total) {
//        for ($i = 0; $i < $total; $i++) {
//            if ($i == 0) {
//                $uri = 'http://mywork.test/index2.php';
//            } else {
//                $uri = 'http://baidu.com';
//            }
//            yield new Request('GET', $uri, [
//                'timeout' => 0.1, // 100����
//                'curl' => [ CURLOPT_NOSIGNAL => true ], //���Ǳ�Ҫ�ģ�
//            ]);
//        }
//    };
//
//    $result = null;
//
//    $pool = new Pool($client3, $requests(2), [
//        'concurrency' => 5,
//        'fulfilled' => function ($response, $index) use (&$result) {
//            /**@var Response $response*/
//            var_dump($response->getStatusCode(), $response->getBody()->getContents());
//        },
//        'rejected' => function ($reason, $index) {
//            var_dump($reason);
//        },
//    ]);
//
//    $t1 = microtime(true);
//
//    // ��������
//    $promise = $pool->promise();
//    // �ȴ��������ɡ�
//    $promise->wait();
//    $t2 = microtime(true);
//    echo ($t2-$t1)*1000;
//
//} catch (Exception $e) {
//    var_dump($e->getMessage());
//}


// �첽����
try{
    $client4 = new Client();
    putenv("GUZZLE_CURL_SELECT_TIMEOUT=0.1");

    $promise0 = $client4->requestAsync(
        'GET',
        //'http://mywork.test/index2.php',
        'https://cn.bing.com',
        [
            'timeout' => 0.2,// 100����
        ]
    );
    $promise0->then(
        function (ResponseInterface $res) {
            var_dump($res->getStatusCode(), $res->getBody()->getContents());
        },
        function (RequestException $e) {
            echo $e->getRequest()->getUri() . ' || ' . $e->getMessage() . "\n";
        }
    )->wait();

    $promise1 = $client4->requestAsync(
        'GET',
        'https://www.baidu.com/',
        [
            'timeout' => 0.1, // 100����
        ]
    );
    $t1 = microtime(true);
    $promise1->then(
        function (ResponseInterface $res) {
            var_dump($res->getStatusCode(), $res->getBody()->getContents());
        },
        function (RequestException $e) {
            echo $e->getRequest()->getUri() . ' || ' . $e->getMessage() . "\n";
        }
    )->wait();
    $promise2 = $client4->requestAsync(
        'GET',
        'https://www.sogou.com',
        [
            'timeout' => 0.2,// 100����
        ]
    );
    $promise2->then(
        function (ResponseInterface $res) {
            var_dump($res->getStatusCode(), $res->getBody()->getContents());
        },
        function (RequestException $e) {
            echo $e->getRequest()->getUri() . ' || ' . $e->getMessage() . "\n";
        }
    )->wait();
    $t2 = microtime(true);
    echo ($t2-$t1)*1000;
} catch (Exception $e) {
    var_dump($e->getMessage());
}