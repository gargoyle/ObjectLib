<?php

namespace Pmc\ObjectLib\Serializable;

use ReflectionClass;

/**
 * @author Gargoyle <g@rgoyle.com>
 */
class ASH
{
    public static function serialize(ArraySerializable $obj): array
    {
        return [
            'className' => get_class($obj),
            'data' => $obj->toArray()
        ];
    }
    
    public static function unserialize(array $serialized)
    {
        if (!isset($serialized['className']) || !isset($serialized['data'])) {
            throw new InvalidSerializedDataException('Serialized data array does not contain required keys "className" and "data".');
        }
        
        $reflectedEventClass = new ReflectionClass((string)$serialized['className']);
        if (!$reflectedEventClass->implementsInterface(ArraySerializable::class)) {
            throw new InvalidSerializedDataException(sprintf(
                    "Class %s does not implement ArraySerializable!", $serialized['className']));
        }
        $obj = $serialized['className']::fromArray($serialized['data']);
        return $obj;
    }
}
