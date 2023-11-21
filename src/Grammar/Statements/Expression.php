<?php

namespace Waffle\Grammar\Statements;

use Waffle\Grammar\Expr;
use Waffle\Grammar\Stmt;

class Expression extends Stmt
{
    public function __construct(
        private readonly Expr $expression
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitExpressionStmt($this);
    }
}