<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;

class Binary extends Expr
{
    public function __construct(
        private readonly Expr $left,
        private readonly Token $operator,
        private readonly Expr $right
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitBinaryExpr($this);
    }
}