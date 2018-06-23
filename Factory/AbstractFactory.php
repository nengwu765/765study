<?php
header('Content-type:text/html;charset=utf-8');
/*
 * 抽象工厂模式
 * 提供一个创建一系列相关或相互依赖对象的接口
 * 注意：这里和工厂方法的区别是：一系列（多个），而工厂方法只有一个
 */

/**
 * Interface people 人类
 */
interface  people
{
    public function  say();
}

/**
 * Class OneMan 第一个男人类-继承people
 */
class OneMan implements people
{
    // 实现people的say方法
    public function say()
    {
        echo '男1：我喜欢你<br>';
    }
}

/**
 * Class TwoMan 第二个男人类-继承people
 */
class TwoMan implements people{
    // 实现people的say方法
    public function say()
    {
        echo '男2：我看上你了<br>';
    }
}

/**
 * Class OneWomen 第一个女人类-继承people
 */
class OneWomen implements people {
    // 实现people的say方法
    public function say()
    {
        echo '女1：我不喜欢你<br>';
    }
}

/**
 * Class TwoWomen 第二个女人类-继承people
 */
class TwoWomen implements people {
    // 实现people的say方法
    public function say()
    {
        echo '女2：滚一边玩去<br>';
    }
}

/**
 * Interface createPeople 创建对象类
 * 注意:这里将对象的创建抽象成了一个接口。
 */
interface  createPeople
{
    // 创建第一个
    public function createOne();
    // 创建第二个
    public function createTwo();

}

/**
 * Class FactoryMan 用于创建男人对象的工厂类-继承createPeople
 */
class FactoryMan implements createPeople
{
    // 创建第一个男人
    public function createOne()
    {
        return new OneMan();
    }

    // 创建第二个男人
    public function createTwo()
    {
        return new TwoMan();
    }
}

/**
 * Class FactoryWomen 用于创建女人对象的工厂类-继承createPeople
 */
class FactoryWomen implements createPeople
{
    // 创建第一个女人
    public function createOne()
    {
        return new OneWomen();
    }

    // 创建第二个女人
    public function createTwo()
    {
        return new TwoWomen();
    }
}

/**
 * Class Client 执行测试类
 */
class  Client {

    // 具体生成对象和执行方法
    public function test() {
        // 男人
        $factory = new FactoryMan();
        $man = $factory->createOne();
        $man->say();

        $man = $factory->createTwo();
        $man->say();

        // 女人
        $factory = new FactoryWomen();
        $man = $factory->createOne();
        $man->say();

        $man = $factory->createTwo();
        $man->say();

    }
}

// 执行
$demo = new Client;
$demo->test();