<?php

namespace Waffle\Grammar\Statements;

interface Visitor
{
    public function visitBlockStmt(Block $stmt);

    public function visitClassStmt(SClass $stmt);

    public function visitExpressionStmt(Expression $stmt);

    public function visitFunctionStmt(SFunction $stmt);

    public function visitIfStmt(SIf $stmt);

    public function visitPrintStmt(SPrint $stmt);

    public function visitReturnStmt(SReturn $stmt);

    public function visitVarStmt(SVar $stmt);

    public function visitWhileStmt(SWhile $stmt);
}