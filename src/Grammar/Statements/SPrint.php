<?php

namespace Waffle\Grammar\Statements;

use Waffle\Grammar\Expr;
use Waffle\Grammar\Stmt;

class SPrint extends Stmt
{
    public function __construct(
        private readonly Expr $expression
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitPrintStmt($this);
    }
}