<?php

namespace Pmc\ObjectLib\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @author Paul Court <emails@paulcourt.co.uk>
 */
class ParameterBagTest extends TestCase
{
    public function testCanBeCreatedWithInitialContents()
    {
        $bag = new \Pmc\ObjectLib\ParameterBag([
            'one' => 1,
            'two' => [2, 3, 4]
        ]);
        
        $this->assertEquals(1, $bag->get('one'));
        $this->assertEquals([2, 3, 4], $bag->get('two'));
    }
    
    public function testWillRejectNonScalarValues()
    {
        $this->expectException(\InvalidArgumentException::class);
        $bag = new \Pmc\ObjectLib\ParameterBag([
            'one' => 1,
            'two' => new \stdClass()
        ]);
    }
    
    public function testWillCheckRequiredItemsArePresent()
    {
        $bag = new \Pmc\ObjectLib\ParameterBag([
            'one' => 1,
            'two' => [2, 3, 4]
        ]);
        $bag->require(['one','two']);
    }
    
    public function testWillThrowExceptionWhenRequiredItemsAreNotInBag()
    {
        $this->expectException(\Pmc\ObjectLib\Exception\MissingBagItemException::class);
        $this->expectExceptionMessage("Required item five is not in the bag!");
        $bag = new \Pmc\ObjectLib\ParameterBag([
            'one' => 1,
            'two' => [2, 3, 4]
        ]);
        $bag->require(['one','five','six']);
    }
    
    public function testWillThrowExceptionWhenRequestedItemIsNotInBag()
    {
        $this->expectException(\Pmc\ObjectLib\Exception\MissingBagItemException::class);
        $this->expectExceptionMessage("Requested item five is not in the bag!");
        $bag = new \Pmc\ObjectLib\ParameterBag([
            'one' => 1,
            'two' => [2, 3, 4]
        ]);
        $bag->get('five');
    }
}
