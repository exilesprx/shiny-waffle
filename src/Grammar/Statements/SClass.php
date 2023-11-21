<?php

namespace Waffle\Grammar\Statements;

use Waffle\Grammar\Expressions\Variable;
use Waffle\Grammar\Stmt;
use Waffle\Token;

class SClass extends Stmt
{
    public function __construct(
        private readonly Token $name,
        private readonly Variable $superclass,
        private readonly array $methods
    ) {
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitClassStmt($this);
    }
}