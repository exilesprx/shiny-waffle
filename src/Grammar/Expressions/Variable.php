<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;
use Waffle\Token;

class Variable extends Expr
{
    public function __construct(
        private readonly Token $name
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitVariableExpr($this);
    }
}