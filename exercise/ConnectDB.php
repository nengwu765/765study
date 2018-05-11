<?php

//以下是实例化一个pdo的带码
$dsn="mysql:host=127.0.0.1;dbname=news_db";
$user="root";
$pwd="123456";
$pdo=new PDO($dsn,$user,$pwd);
$pdo->query("set names utf8");