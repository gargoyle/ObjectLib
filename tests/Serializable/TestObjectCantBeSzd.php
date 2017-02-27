<?php

namespace Pmc\ObjectLib\Tests\Serializable;

/**
 * @author Gargoyle <g@rgoyle.com>
 */
class TestObjectCantBeSzd
{

    private $foo;

    public function __construct(string $val = "bar")
    {
        $this->foo = $val;
    }

    public function getFoo(): string
    {
        return $this->foo;
    }
}
