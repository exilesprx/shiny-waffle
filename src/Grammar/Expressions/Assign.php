<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;
use Waffle\Token;

class Assign extends Expr
{
    public function __construct(
        private readonly Token $name,
        private readonly Expr $value
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitAssignExpr($this);
    }
}