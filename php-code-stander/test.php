<?php
/**
 * Created by PhpStorm.
 * User: nwqian
 * Date: 16-1-4
 * Time: 下午1:18
 */

$testClass = new TestCodeStandards;
$testClass->test();


class TestCodeStandards{
    function test(){
        echo 'This is a PHP_CodeSniffer test';

        $i =1 ;
        if ($i== 1) {
            echo 'Hello';
        };

    }
}

