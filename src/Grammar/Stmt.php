<?php

namespace Waffle\Grammar;

use Waffle\Grammar\Statements\Visitor;

abstract class Stmt
{
    abstract public function accept(Visitor $visitor);
}