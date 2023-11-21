<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;

class Literal extends Expr
{
    public function __construct(
        private readonly mixed $value
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitLiteralExpr($this);
    }
}