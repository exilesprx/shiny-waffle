<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Waffle\AstPrinter;
use Waffle\Grammar\Expr;
use Waffle\Grammar\Expressions\Binary;
use Waffle\Grammar\Expressions\Grouping;
use Waffle\Grammar\Expressions\Literal;
use Waffle\Grammar\Expressions\Unary;
use Waffle\Token;
use Waffle\TokenType;

class AstPrinterTest extends TestCase
{
    private AstPrinter $printer;
    private Expr $expr;

    protected function setUp(): void
    {
        $this->printer = new AstPrinter();
        $this->expr = new Binary(
            new Unary(
                new Token(TokenType::MINUS, "-", null, 1),
                new Literal(123)
            ),
            new Token(TokenType::STAR, "*", null, 1),
            new Grouping(
                new Literal(45.67)
            )
        );
    }

    /** @test */
    public function it_expects_missing_parenthesis_and_additional_space_not_to_match(): void
    {
        $this->assertNotEquals(
            "* (- 123) (group 45.67) )",
            $this->printer->printExpr($this->expr),
            "Missing parenthesis and additional space should not to match"
        );
    }

    /** @test */
    public function it_expects_the_printed_expression_to_match_exactly(): void
    {
        $this->assertEquals(
            "(* (- 123) (group 45.67))",
            $this->printer->printExpr($this->expr),
            "The printed expression should match exactly"
        );
    }
}
