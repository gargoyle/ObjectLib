<?php

namespace Pmc\ObjectLib\Tests;

/**
 * @author Paul Court <emails@paulcourt.co.uk>
 */
class TestBasicString extends \Pmc\ObjectLib\BasicString
{
    // Retuce max length for testing...
    public function __construct(string $value, bool $allowEmpty = false, int $maxLength = 50)
    {
        parent::__construct($value,$allowEmpty,$maxLength);
    }

}
