<?php


namespace Foo;
class Bar
{
    public function test()
    {
        echo "test";
    }
}

var_dump(class_exists('Bar'), class_exists('\\Foo\\Bar\\Test'));