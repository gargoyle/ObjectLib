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
        $this->value = Uuid::uuid4();
    }

    public function __toString(): string
    {
        $this->value->toString();
    }
    
    public function equals(self $other): bool
    {
        return ($this->value->toString() == $other->value->toString());
    }

    public static function fromString(string $id): self
    {
        $this->value = Uuid::fromString($id);
    }

}
