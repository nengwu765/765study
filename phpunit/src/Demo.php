<?php

namespace My\Unit;

use PHPUnit\Runner\Exception;

class Demo
{
    private $attr;

    public function __construct(string $attr = 'demo')
    {
        $this->attr = mb_strtolower($attr);
    }

    public function getAttr()
    {
        return 'The unique attr of class Demo is: ' . $this->attr;
    }

    public function setAttr($attr)
    {
        $attr = mb_strtolower($attr);
        if ($attr == $this->attr) {
            throw new Exception(
                sprintf('Warning: %s is already set.', $this->attr)
            );
        }
        $this->attr = $attr;
        return 'success';
    }
}