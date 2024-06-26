<?php

namespace Waffle;

use Stringable;

class Token implements Stringable
{
    public function __construct(
        public readonly TokenType $type,
        public readonly string $lexeme,
        public readonly mixed $literal,
        public readonly int $line
    ) {
    }

    public function __toString(): string
    {
        return sprintf("%s %s %s\n", $this->type->name, $this->lexeme, $this->literal);
    }
}
