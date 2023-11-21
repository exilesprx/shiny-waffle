<?php

namespace Waffle\Grammar;

use Waffle\Grammar\Expressions\Visitor;

abstract class Expr
{
    abstract public function accept(Visitor $visitor);
}