<?php

namespace Waffle\Grammar\Statements;

use Waffle\Grammar\Expr;
use Waffle\Grammar\Stmt;
use Waffle\Token;

class SReturn extends Stmt
{
    public function __construct(
        private readonly Token $keyword,
        private readonly Expr $value
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitReturnStmt($this);
    }
}