<?php

namespace Pmc\ObjectLib\Serializable;

/**
 * @author Gargoyle <g@rgoyle.com>
 */
interface ArraySerializable
{
    public function toArray(): array;
    public static function fromArray(array $data);
}
