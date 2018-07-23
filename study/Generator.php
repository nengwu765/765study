<?php

//function myGenerator()
// {
//    yield "value1";
//    yield "value2";
//    yield "value3";
//}
//
//foreach (myGenerator() as $yieldValue) {
//    echo $yieldValue . PHP_EOL;
//}


/**
 * 使用生成器
 * 一次只会为csv文件中的一行分配内存
 *
 * @param $file
 * @return Generator
 * @throws Exception
 */
function getRows($file)
{
    $handle = fopen($file, 'rb');
    if ($handle === false) {
        throw new Exception();
    }
    while (feof($handle) === false) {
        yield fgetcsv($handle);
    }
    fclose($handle);
}

foreach (getRows('data.csv') as $row) {
    print_r($row);
}