<?php

namespace Pmc\ObjectLib;

/**
 * Represents a basic single line "visible" string value with ASCII control characters
 * (below 32) stripped out.
 *
 * @author Gargoyle <g@rgoyle.com>
 */
abstract class BasicString
{
    protected $value;

    public function __construct(string $value, bool $allowEmpty = false, int $maxLength = 255)
    {
        $sanitizedValue = filter_var(
                trim($value), FILTER_SANITIZE_STRING,
                array('flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_NO_ENCODE_QUOTES));

        if ((!$allowEmpty) && empty($sanitizedValue)) {
            throw new \InvalidArgumentException(sprintf(
                    'Empty value not permitted for %s', 
                    static::class));
        }

        // Add a constraint of 50 chars.
        if (mb_strlen($sanitizedValue) > $maxLength) {
            throw new \InvalidArgumentException(sprintf(
                    'Value cannot be longer than %s characters',
                    $maxLength));
        }
        
        $this->value = (string)$sanitizedValue;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(BasicString $otherString): bool
    {
        return $otherString->value === $this->value;
    }
}