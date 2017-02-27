<?php

namespace Pmc\ObjectLib\Tests\Serializable;

use PHPUnit\Framework\TestCase;
use Pmc\ObjectLib\Serializable\ {
    ASH,
    InvalidSerializedDataException
};

/**
 * @author Gargoyle <g@rgoyle.com>
 */
class ASHTest extends TestCase
{
    public function testObjectIsSerialized()
    {
        $obj = new TestObjectToBeSzd();
        $serialized = ASH::serialize($obj);
        $this->assertArrayHasKey('className', $serialized);
        $this->assertArrayHasKey('data', $serialized);
        $this->assertEquals('bar', $serialized['data']['foo']);
    }
    
    public function serializedDataProvider()
    {
        return [
            [['className' => TestObjectToBeSzd::class, 'data' => ['foo' => 'baz']], TestObjectToBeSzd::class, 'baz'],
            [['className' => TestObjectToBeSzd::class, 'data' => ['foo' => 'test']], TestObjectToBeSzd::class, 'test'],
        ];
    }
    
    /**
     * @dataProvider serializedDataProvider
     */
    public function testObjectIsUnserialized($data, $expectedClass, $expectedFoo)
    {
        $obj = ASH::unserialize($data);
        $this->assertInstanceOf($expectedClass, $obj);
        $this->assertEquals($expectedFoo, $obj->getFoo());
    }
    
    
    public function badSerializedDataProvider()
    {
        return [
            [['data' => ['foo' => 'baz']], TestObjectToBeSzd::class, 'baz'],
            [['className' => TestObjectToBeSzd::class], TestObjectToBeSzd::class, 'test'],
        ];
    }
    
    /**
     * @dataProvider badSerializedDataProvider
     */
    public function testThrowsExceptionWithInvalidSerializedData($data, $expectedClass, $expectedFoo)
    {
        $this->expectException(InvalidSerializedDataException::class);
        $obj = ASH::unserialize($data);
    }
    
    public function testThrowsExceptionWhenObjectDoesntImplementInterface()
    {
        $this->expectException(InvalidSerializedDataException::class);
        $obj = ASH::unserialize(['className' => TestObjectCantBeSzd::class, 'data' => ['foo' => 'bar']]);
    }
}
