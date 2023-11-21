<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;
use Waffle\Token;

class Super extends Expr
{
    public function __construct(
        private readonly Token $keyword,
        private readonly Token $method
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitSuperExpr($this);
    }
}