<?php

namespace Waffle\Grammar\Statements;

use Waffle\Grammar\Stmt;

class SBlock extends Stmt
{
    public function __construct(
        private readonly array $statements
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitBlockStmt($this);
    }
}