<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;
use Waffle\Token;

class EThis extends Expr
{
    public function __construct(
        private readonly Token $keyword
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitThisExpr($this);
    }
}