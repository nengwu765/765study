<?php

use My\Unit\Demo;
use PHPUnit\Framework\TestCase;

class DemoTest extends TestCase
{
    public function testSetUniqueAttrInConstructor()
    {
        $demo = new Demo('kkk');
        $this->assertAttributeEquals('kkk', 'attr', $demo);
    }

    public function testGetAttr()
    {
        $demo = new Demo('test');
        $this->assertEquals('The unique attr of class Demo is: test', $demo->getAttr());
    }

    public function testSetAttr()
    {
        $demo = new Demo('ok');
        $this->assertEquals('success', $demo->setAttr('ok-ok'));
    }

    public function expectSetAttr()
    {
        $demo = new Demo('ok');
        $demo->setAttr('ok');
    }
}