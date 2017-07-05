<?php

namespace Pmc\ObjectLib\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @author Paul Court <emails@paulcourt.co.uk>
 */
class JsonTest extends TestCase
{
    public function testWillEncodeUsingExpectedOptions()
    {
        $jsonstring = \Pmc\ObjectLib\Json::encode([
            'number' => 1234,
            'zero fraction' => 2.0,
            'unicode' => '€ 😀',
            'unescaped slashes' => 'https://ga.rgoyle.com'
            ]);
        $this->assertEquals('{"number":1234,"zero fraction":2.0,"unicode":"€ 😀","unescaped slashes":"https://ga.rgoyle.com"}', $jsonstring);
    }
    
    public function testWillDecodeIntoOriginalForm()
    {
        $data = \Pmc\ObjectLib\Json::decode('{"number":1234,"zero fraction":2.0,"unicode":"€ 😀","unescaped slashes":"https://ga.rgoyle.com"}');
        $this->assertEquals(1234, $data['number']);
        $this->assertEquals(2.0, $data['zero fraction']);
        $this->assertEquals('€ 😀', $data['unicode']);
        $this->assertEquals('https://ga.rgoyle.com', $data['unescaped slashes']);
    }
}
