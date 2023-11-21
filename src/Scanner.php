<?php

namespace Waffle;

class Scanner
{
    private array $tokens;
    private int $start;
    private int $current;
    private int $line;

    public function __construct(
        private readonly string $source
    )
    {
        $this->tokens = [];
        $this->start = 0;
        $this->current = 0;
        $this->line = 1;
    }

    public function scanTokens(): array
    {
        while(!$this->isAtEnd()) {
            $this->start = $this->current;
            $this->scanToken();
        }

        $this->tokens[] = new Token(TokenType::EOF, "", null, $this->line);
        return $this->tokens;
    }

    private function isAtEnd(): bool
    {
        return $this->current >= strlen($this->source);
    }

    private function scanToken(): void
    {
        $char = $this->advance();
        match ($char) {
            '(' => $this->addToken(TokenType::LEFT_PAREN),
            ')' => $this->addToken(TokenType::RIGHT_PAREN),
            '{' => $this->addToken(TokenType::LEFT_BRACE),
            '}' => $this->addToken(TokenType::RIGHT_BRACE),
            ',' => $this->addToken(TokenType::COMMA),
            '.' => $this->addToken(TokenType::DOT),
            '-' => $this->addToken(TokenType::MINUS),
            '+' => $this->addToken(TokenType::PLUS),
            ';' => $this->addToken(TokenType::SEMICOLON),
            '*' => $this->addToken(TokenType::STAR),
            '!' => $this->addToken($this->match('=') ? TokenType::BANG_EQUAL : TokenType::BANG),
            '=' => $this->addToken($this->match('=') ? TokenType::EQUAL_EQUAL : TokenType::EQUAL),
            '<' => $this->addToken($this->match('=') ? TokenType::LESS_EQUAL : TokenType::LESS),
            '>' => $this->addToken($this->match('=') ? TokenType::GREATER_EQUAL : TokenType::GREATER),
            '/' => (function() {
                if ($this->match('/')) {
                    // keep advancing until the comment ends
                    while ($this->peek() != '\n' && !$this->isAtEnd()) {
                        $this->advance();
                    }
                    return;
                } elseif ($this->match('*')) {
                    while($this->peek() != '*' && $this->peekNext() != '/' && !$this->isAtEnd()) {
                        if ($this->peek() == '\n') {
                            $this->line++;
                        }

                        $this->advance();
                    }
                    // consume the asterisk
                    $this->advance();

                    // consume the slash
                    $this->advance();
                    return;
                }

                $this->addToken(TokenType::SLASH);
            })(),
            ' ', '\r', '\t' => null, // ignore white spaces
            '\n' => $this->line++,
            '"' => $this->string(),
            default => (function() use($char) {
                if ( $this->isDigit($char)) {
                    $this->number();
                } elseif ($this->isAlpha($char)) {
                    $this->identifier();
                } else {
                    Plox::error($this->line, "Unexpected character.");
                }
            })()
        };
    }

    private function advance(): string
    {
        return $this->source[$this->current++];
    }

    private function addToken(TokenType $type, mixed $literal = null): void
    {
        $text = substr($this->source, $this->start, $this->current - $this->start);
        $this->tokens[] = new Token($type, $text, $literal, $this->line);
    }

    private function match(string $expected): bool
    {
        if($this->isAtEnd()) {
            return false;
        }

        if ($this->source[$this->current] != $expected) {
            return false;
        }

        $this->current++;
        return true;
    }

    private function peek(): string
    {
        if ($this->isAtEnd()) {
            return '\0';
        }

        return $this->source[$this->current];
    }

    private function string(): void
    {
        // support multi-line comments
        while($this->peek() != '"' && !$this->isAtEnd()) {
            if ($this->peek() == '\n') {
                $this->line++;
            }
            $this->advance();
        }

        if ($this->isAtEnd()) {
            Plox::error($this->line, "Unterminated string");
            return;
        }

        $this->advance(); // the closing quote

        //  trim quotes
        $string = substr($this->source, $this->start + 1, $this->current - $this->start - 2);
        $this->addToken(TokenType::STRING, $string);
    }

    private function isDigit(string $char): bool
    {
        return $char >= '0' && $char <= '9';
    }

    private function number(): void
    {
        $this->consumeDigits();

        if ($this->peek() == "." && $this->isDigit($this->peekNext())) {
            $this->advance();

            $this->consumeDigits();
        }

        $this->addToken(TokenType::NUMBER, (float)substr($this->source, $this->start, $this->current - $this->start));
    }

    private function consumeDigits(): void
    {
        while ($this->isDigit($this->peek())) {
            $this->advance();
        }
    }

    private function peekNext(): string
    {
        if ($this->current + 1 > strlen($this->source)) {
            return '\0';
        }

        return $this->source[$this->current + 1];
    }

    private function isAlpha(string $char): bool
    {
        return ($char >= 'a' && $char <= 'z')
            || ($char >= 'A' && $char <= 'Z')
            || $char == '_';
    }

    private function identifier(): void
    {
        while( $this->isAlphaNumeric($this->peek())) {
            $this->advance();
        }

        $text = substr($this->source, $this->start, $this->current - $this->start);
        $type = Keywords::getTypeFrom($text);
        if (! $type) {
            $type = TokenType::IDENTIFIER;
        }

        $this->addToken($type);
    }

    private function isAlphaNumeric(string $char): bool
    {
        return $this->isAlpha($char) || $this->isDigit($char);
    }
}