<?php

namespace Waffle\Grammar\Statements;

use Waffle\Grammar\Stmt;
use Waffle\Token;

class SFunction extends Stmt
{
    public function __construct(
        private readonly Token $name,
        private readonly array $params,
        private readonly array $body
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitFunctionStmt($this);
    }
}