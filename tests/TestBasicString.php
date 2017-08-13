<?php

namespace Pmc\ObjectLib\Tests;

use Pmc\ObjectLib\BasicString;

/**
 * @author Paul Court <emails@paulcourt.co.uk>
 */
class TestBasicString extends BasicString
{
    // Retuce max length for testing...
    public function __construct(string $value, bool $allowEmpty = false, int $maxLength = 50)
    {
        parent::__construct($value,$allowEmpty,$maxLength);
    }

}
