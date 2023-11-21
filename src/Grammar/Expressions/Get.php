<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;
use Waffle\Token;

class Get extends Expr
{
    public function __construct(
        private readonly Expr $object,
        private readonly Token $name
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitGetExpr($this);
    }
}