<?php

namespace Pmc\ObjectLib\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Pmc\ObjectLib\Tests\TestBasicString;

/**
 * TestBasicString unit test
 *
 * @author Gargoyle <g@rgoylecom>
 */
class TestBasicStringTest extends TestCase
{

    /**
     * Data provider
     */
    public function stringsWithNonPrintableCharacters()
    {
        return array(
            array("Joe\n Bloggs", 'Joe Bloggs'),
            array("Joe\t\r\0 Bloggs", 'Joe Bloggs'),
        );
    }

    /**
     * Data provider
     */
    public function stringsWithUTF8Characters()
    {
        return array(
            array("Joe Bloggs 😝😍", 'Joe Bloggs 😝😍'),
            array("Joe Bloggs £", 'Joe Bloggs £'),
        );
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testWillNotConstructWithBlankString()
    {
        $name = new TestBasicString('');
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testWillNotConstructWhenStringIsLongerThanMaxAllowed()
    {
        $name = new TestBasicString('1234567890-1234567890-1234567890-1234567890-1234567890');
    }
    
    

    public function testWillCastToString()
    {
        $name = new TestBasicString('Joe Bloggs');
        $this->assertEquals('Joe Bloggs', (string)$name);
        $this->assertEquals('Joe Bloggs', "" . $name);
    }

    public function testApostropheInString()
    {
        $name = new TestBasicString("Française O'Brien");
        $this->assertEquals("Française O'Brien", $name);
    }


    /**
     * @dataProvider stringsWithNonPrintableCharacters
     */
    public function testNonPrintableCharactersAreSanitised($actual, $expected)
    {
        $name = new TestBasicString($actual);
        $this->assertEquals($expected, (string)$name);
    }

    /**
     * @dataProvider stringsWithUTF8Characters
     */
    public function testUtf8CharactersArePreserved($actual, $expected)
    {
        $name = new TestBasicString($actual);
        $this->assertEquals($expected, (string)$name);
    }

    public function testIsEqualToOtherWithTheSameValue()
    {
        $stringOne = new TestBasicString('Alan');

        $stringTwo = new TestBasicString('Alan');

        $this->assertTrue($stringOne->equals($stringTwo),
            'equals must return true if both TestBasicString instances possess the same value');
    }

    public function testIsNotEqualToOtherWithDifferentValue()
    {
        $stringOne = new TestBasicString('Alan');

        $stringTwo = new TestBasicString('Dave');

        $this->assertFalse($stringOne->equals($stringTwo),
            'equals must return false if both TestBasicString instances do not possess the same value');
    }
}