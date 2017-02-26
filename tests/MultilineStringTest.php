<?php

namespace Pmc\ObjectLib\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Pmc\ObjectLib\MultilineString;

/**
 * @author Gargoyle <g@rgoyle.com>
 */
class MultilineStringTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testWillNotConstructWithBlankString()
    {
        $name = new MultilineString('');
    }
    
    public function testBlankStringsAllowedWithAdditionalFlag()
    {
        $name = new MultilineString('', true);
    }

    public function testQuotesArePreserved()
    {
        $mlString = new MultilineString("Hello Awesome \"Test\" String.");
        $this->assertEquals("Hello Awesome \"Test\" String.", (string)$mlString);
    }

    public function testNewlinesArePreserved()
    {
        $mlString = new MultilineString("Joe\n Bloggs");
        $this->assertEquals("Joe\n Bloggs", (string)$mlString);
    }

    public function testUtf8CharsArePreserved()
    {
        $mlString = new MultilineString('Joe Bloggs 😝😍');
        $this->assertEquals('Joe Bloggs 😝😍', (string)$mlString);
    }
}