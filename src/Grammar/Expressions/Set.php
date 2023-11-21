<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;

class Set extends Expr
{
    public function __construct(
        private readonly Expr $object,
        private readonly Token $name,
        private readonly Expr $value
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitSetExpr($this);
    }
}