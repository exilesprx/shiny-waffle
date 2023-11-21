<?php

namespace Waffle\Grammar\Statements;

use Waffle\Grammar\Expr;
use Waffle\Grammar\Stmt;
use Waffle\Token;

class SVar extends Stmt
{
    public function __construct(
        private readonly Token $name,
        private readonly Expr $initializer
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitVarStmt($this);
    }
}