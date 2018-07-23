<?php

use My\Unit\Hello;
use PHPUnit\Framework\TestCase;

class HelloTest extends TestCase
{
    public function testSay()
    {
        $obj = new Hello();
        $this->assertEquals('hello qian', $obj->say('qian'));
    }
}