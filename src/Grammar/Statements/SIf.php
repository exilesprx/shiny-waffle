<?php

namespace Waffle\Grammar\Statements;

use Waffle\Grammar\Expr;
use Waffle\Grammar\Stmt;

class SIf extends Stmt
{
    public function __construct(
        private readonly Expr $condition,
        private readonly Stmt $thenBranch,
        private readonly Stmt $elseBranch
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitIfStmt($this);
    }
}