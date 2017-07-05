<?php

namespace Pmc\ObjectLib;

/**
 * A simple wrapper around json_encode/decode to set the options I use 90% of the 
 * time.
 */
class Json
{
    public static function decode(string $dataAsJson): array
    {
        return json_decode($dataAsJson, true);
    }
    
    public static function encode(array $data): string
    {
        return json_encode($data,
                JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}
