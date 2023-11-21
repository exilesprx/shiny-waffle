<?php

namespace Waffle;

use Waffle\Grammar\Expr;
use Waffle\Grammar\Expressions\Assign;
use Waffle\Grammar\Expressions\Binary;
use Waffle\Grammar\Expressions\Call;
use Waffle\Grammar\Expressions\EThis;
use Waffle\Grammar\Expressions\Get;
use Waffle\Grammar\Expressions\Grouping;
use Waffle\Grammar\Expressions\Literal;
use Waffle\Grammar\Expressions\Logical;
use Waffle\Grammar\Expressions\Set;
use Waffle\Grammar\Expressions\Super;
use Waffle\Grammar\Expressions\Unary;
use Waffle\Grammar\Expressions\Variable;

class AstPrinter implements Grammar\Expressions\Visitor
{
    public function printExpr(Expr $expr): string
    {
        return $expr->accept($this);
    }

    public function visitAssignExpr(Assign $expr)
    {
        // TODO: Implement visitAssignExpr() method.
    }

    public function visitBinaryExpr(Binary $expr)
    {
        return $this->parenthesize(
            $expr->operator->lexeme,
            $expr->left,
            $expr->right
        );
    }

    public function visitCallExpr(Call $expr)
    {
        // TODO: Implement visitCallExpr() method.
    }

    public function visitGetExpr(Get $expr)
    {
        // TODO: Implement visitGetExpr() method.
    }

    public function visitGroupingExpr(Grouping $expr)
    {
        return $this->parenthesize(
            "group",
            $expr->expression
        );
    }

    public function visitLiteralExpr(Literal $expr)
    {
        if (is_null($expr->value)) {
            return "nil";
        }
        return (string)$expr->value;
    }

    public function visitLogicalExpr(Logical $expr)
    {
        // TODO: Implement visitLogicalExpr() method.
    }

    public function visitSetExpr(Set $expr)
    {
        // TODO: Implement visitSetExpr() method.
    }

    public function visitSuperExpr(Super $expr)
    {
        // TODO: Implement visitSuperExpr() method.
    }

    public function visitThisExpr(EThis $expr)
    {
        // TODO: Implement visitThisExpr() method.
    }

    public function visitUnaryExpr(Unary $expr)
    {
        return $this->parenthesize(
            $expr->operator->lexeme,
            $expr->right
        );
    }

    public function visitVariableExpr(Variable $variable)
    {
        // TODO: Implement visitVariableExpr() method.
    }

    private function parenthesize(string $name, Expr...$exprs): string
    {
        $parts = [];
        $parts[] = "(";
        $parts[] = $name;
        foreach ($exprs as $expr) {
            $parts[] = " ";
            $parts[] = $expr->accept($this);
        }
        $parts[] = ")";

        return implode($parts);
    }
}