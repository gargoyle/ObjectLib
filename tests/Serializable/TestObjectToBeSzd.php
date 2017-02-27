<?php

namespace Pmc\ObjectLib\Tests\Serializable;

use Pmc\ObjectLib\Serializable\ArraySerializable;

/**
 * @author Gargoyle <g@rgoyle.com>
 */
class TestObjectToBeSzd implements ArraySerializable
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
    
    public function toArray(): array
    {
        return ['foo' => $this->foo];
    }

    public static function fromArray(array $data)
    {
        $instance = new self();
        $instance->foo = $data['foo'];
        return $instance;
    }

}
