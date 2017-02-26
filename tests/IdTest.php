<?php

namespace Pmc\ObjectLib\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @author Paul Court <emails@paulcourt.co.uk>
 */
class IdTest extends TestCase
{
    public function testNewInstanceHasNewId()
    {
        $newId = new \Pmc\ObjectLib\Id();
//        echo $newId;
        $this->assertNotEmpty((string)$newId);
    }
    
    public function testCanCreateFromExistingId()
    {
        $id = \Pmc\ObjectLib\Id::fromString('4d761e68-fc30-11e6-8e7c-80e650033120');
        $this->assertEquals('4d761e68-fc30-11e6-8e7c-80e650033120', (string)$id);
    }
    
    public function testTheSameIdsAreEqual()
    {
        $idOne = \Pmc\ObjectLib\Id::fromString('4d761e68-fc30-11e6-8e7c-80e650033120');
        $idTwo = \Pmc\ObjectLib\Id::fromString('4d761e68-fc30-11e6-8e7c-80e650033120');
        $this->assertTrue($idOne->equals($idTwo));
    }
}
