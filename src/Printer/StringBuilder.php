<?php

namespace Waffle\Printer;

use Stringable;

/**
 * Basic string builder class just for fun
 */
class StringBuilder implements Stringable
{
    private array $parts;

    public function __construct()
    {
        $this->parts = [];
    }

    public function append(string $string): self
    {
        $this->parts[] = $string;
        return $this;
    }

    public function __toString(): string
    {
        return implode($this->parts);
    }
}