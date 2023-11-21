<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;

class Grouping extends Expr
{
    public function __construct(
        private readonly Expr $grouping
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitGroupingExpr($this);
    }
}