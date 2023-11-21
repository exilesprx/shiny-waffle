<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;
use Waffle\Token;

class Binary extends Expr
{
    public function __construct(
        public readonly Expr $left,
        public readonly Token $operator,
        public readonly Expr $right
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitBinaryExpr($this);
    }
}