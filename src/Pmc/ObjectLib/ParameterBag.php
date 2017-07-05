<?php

namespace Pmc\ObjectLib;

use Countable;
use InvalidArgumentException;
use Pmc\ObjectLib\Exception\MissingBagItemException;

/**
 * Simply a wrapper around an associative array of key => values with helper
 * methods.
 * 
 * @author Gargoyle <g@rgoyle.com>
 */
class ParameterBag implements Countable
{

    private $contents;

    public function __construct(array $initialContents = [])
    {
        $this->contents = [];
        $this->add($initialContents);
    }

    public function add(array $contents): void
    {
        array_walk_recursive($contents, function($value, $key){
            if (!is_scalar($value)) {
                throw new InvalidArgumentException("ParameterBag can only hold scalar values!");
            }
        });
        $this->contents = array_merge($this->contents, $contents);
    }

    public function get(string $key)
    {
        if (!isset($this->contents[$key])) {
            throw new MissingBagItemException(sprintf(
                    "Requested item %s is not in the bag!",
                    $key
            ));
        }
        return $this->contents[$key];
    }

    public function require(array $keys): void
    {
        foreach ($keys as $key) {
            if (!isset($this->contents[$key])) {
                throw new MissingBagItemException(sprintf(
                        "Required item %s is not in the bag!",
                        $key
                ));
            }
        }
    }

    public function count(): int
    {
        return count($this->contents);
    }

}
