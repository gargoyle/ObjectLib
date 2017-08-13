<?php

namespace Pmc\ObjectLib;

/**
 * Provides an interface for mapping class names to non implementation specific names.
 * 
 * @author Gargoyle <g@rgoyle.com>
 */
interface ClassNameMap
{
    public function getNameForClass(string $className);
    public function getClassForName(string $name);
}
