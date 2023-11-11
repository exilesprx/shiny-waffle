<?php

namespace Waffle;

use Stringable;

class Token implements Stringable
{
    public function __construct(
        private TokenType $type,
        private string $lexeme,
        private mixed $literal,
        private int $line
    )
    {
    }

    public function __toString(): string
    {
        return sprintf("%s %s %s\n", $this->type->name, $this->lexeme, $this->literal);
    }
}