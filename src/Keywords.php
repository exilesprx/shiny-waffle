<?php

namespace Waffle;

class Keywords
{
    private static array $keywords = [
        'and' => TokenType::AND,
        'class' => TokenType::ENTITY,
        'else' => TokenType::ELSE,
        'false' => TokenType::FALSE,
        'for' => TokenType::FOR,
        'fun' => TokenType::FUN,
        'if' => TokenType::IF,
        'nil' => TokenType::NIL,
        'or' => TokenType::OR,
        'print' => TokenType::PRINT,
        'return' => TokenType::RETURN,
        'super' => TokenType::SUPER,
        'this' => TokenType::THIS,
        'true' => TokenType::TRUE,
        'var' => TokenType::VAR,
        'while' => TokenType::WHILE
    ];

    public static function get(string $text): ?TokenType
    {
        if (isset(self::$keywords[$text])) {
            return self::$keywords[$text];
        }

        return null;
    }
}