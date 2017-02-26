<?php

namespace Pmc\ObjectLib;

use Ramsey\Uuid\Uuid;

/**
 * A wrapper for \Ramsey\Uuid\Uuid to only expose the version 4 UUID and provide
 * a simplified interface.
 * 
 * @author Gargoyle <g@rgoyle.com>
 */
class Id
{

    protected $value;

    public function __construct()
    {
        $this->value = Uuid::uuid1();
    }

    public function __toString(): string
    {
        return $this->value->toString();
    }
    
    public function equals(self $other): bool
    {
        return ($this->value->toString() == $other->value->toString());
    }

    public static function fromString(string $id): self
    {
        $instance = new static();
        $instance->value = Uuid::fromString($id);
        return $instance;
    }

}
