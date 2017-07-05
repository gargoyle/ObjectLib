<?php

namespace Pmc\ObjectLib;

/**
 * A sanitised multiline string.
 *
 * @author Gargoyle <g@rgoyle.com>
 */
class MultilineString
{
    protected $errorMessage = 'MultilineString values cannot be blank.';

    /**
     * @var string
     */
    protected $value;

    public function __construct($value, $allowEmpty = false)
    {        
        $sanitizedValue = filter_var(trim($value),
                FILTER_SANITIZE_STRING,
                array('flags' => FILTER_FLAG_NO_ENCODE_QUOTES));

        if (empty($sanitizedValue) && (!$allowEmpty)) {
            throw new \InvalidArgumentException($this->errorMessage);
        }

        $this->value = $sanitizedValue;
    }

    public function __toString()
    {
        return $this->value;
    }
}

