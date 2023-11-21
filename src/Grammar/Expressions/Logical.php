<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;
use Waffle\Token;

class Logical extends Expr
{
    public function __construct(
        private readonly Expr $left,
        private readonly Token $operator,
        private readonly Expr $right
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitLogicalExpr($this);
    }
}