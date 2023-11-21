<?php

namespace Waffle\Grammar\Statements;

use Waffle\Grammar\Expr;
use Waffle\Grammar\Stmt;

class SWhile extends Stmt
{
    public function __construct(
        private readonly Expr $condition,
        private readonly Stmt $body
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitWhileStmt($this);
    }
}