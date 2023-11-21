<?php

namespace Waffle\Grammar\Expressions;

use Waffle\Grammar\Expr;
use Waffle\Token;

class Call extends Expr
{
    public function __construct(
        private readonly Expr $callee,
        private readonly Token $paren,
        private readonly array $argments
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitCallExpr($this);
    }
}