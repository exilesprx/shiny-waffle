<?php

namespace Waffle;

use Waffle\Exceptions\ParseError;
use Waffle\Grammar\Expr;
use Waffle\Grammar\Expressions\Binary;
use Waffle\Grammar\Expressions\Grouping;
use Waffle\Grammar\Expressions\Literal;
use Waffle\Grammar\Expressions\Unary;

class Parser
{
    private int $current = 0;

    public function __construct(
        private array $tokens
    ) {
    }

    private function expression(): Expr
    {
        return $this->equality();
    }

    private function equality(): Expr
    {
        $expr = $this->comparison();

        while ($this->match(TokenType::BANG_EQUAL, TokenType::EQUAL_EQUAL)) {
            $operator = $this->previous();
            $right = $this->comparison();
            $expr = new Binary(left: $expr, operator: $operator, right: $right);
        }

        return $expr;
    }

    private function comparison(): Expr
    {
        $expr = $this->term();

        while ($this->match(TokenType::GREATER, TokenType::GREATER_EQUAL, TokenType::LESS, TokenType::LESS_EQUAL)) {
            $operator = $this->previous();
            $right = $this->term();
            $expr = new Binary(left: $expr, operator: $operator, right: $right);
        }

        return $expr;
    }

    private function term(): Expr
    {
        $expr = $this->factor();

        while ($this->match(TokenType::MINUS, TokenType::PLUS)) {
            $operator = $this->previous();
            $right = $this->factor();
            $expr = new Binary(left: $expr, operator: $operator, right: $right);
        }
        return $expr;
    }

    private function factor(): Expr
    {
        $expr = $this->unary();

        while ($this->match(TokenType::SLASH, TokenType::STAR)) {
            $operator = $this->previous();
            $right = $this->unary();
            $expr = new Binary(left: $expr, operator: $operator, right: $right);
        }
        return $expr;
    }

    private function unary(): Expr
    {
        if ($this->match(TokenType::BANG, TokenType::MINUS)) {
            $operator = $this->previous();
            $right = $this->unary();
            return new Unary($operator, $right);
        }
        return $this->primary();
    }

    private function primary(): Expr
    {
        if ($this->match(TokenType::FALSE)) {
            return new Literal(false);
        }

        if ($this->match(TokenType::TRUE)) {
            return new Literal(true);
        }

        if ($this->match(TokenType::NIL)) {
            return new Literal(null);
        }

        if ($this->match(TokenType::NUMBER, TokenType::STRING)) {
            return new Literal($this->previous()->literal);
        }

        if ($this->match(TokenType::LEFT_PAREN)) {
            $expr = $this->expression();
            $this->consume(TokenType::RIGHT_PAREN, "Expect ')' after expression.");
            return new Grouping($expr);
        }
    }

    private function match(int ...$types): bool
    {
        foreach($types as $type) {
            if ($this->check($type)) {
                $this->advance();
                return true;
            }
        }
        return false;
    }

    private function consume(TokenType $type, string $message): Token
    {
        if ($this->check($type)) {
            return $this->advance();
        }

        return $this->error($this->peek(), $message);
    }

    private function error(Token $token, string $message): void
    {
        Plox::error($token, $message);
        throw new ParseError();
    }

    private function check(TokenType $type): bool
    {
        if ($this->isAtEnd()) {
            return false;
        }

        return $this->peek()->type == $type;
    }

    private function advance(): Token
    {
        if (!$this->isAtEnd()) {
            $this->current++;
        }
        return $this->previous();
    }

    private function isAtEnd(): bool
    {
        return $this->peek()->type == TokenType::EOF;
    }

    private function peek(): Token
    {
        return $this->tokens[$this->current];
    }

    private function previous(): Token
    {
        return $this->tokens[$this->current - 1];
    }
}
