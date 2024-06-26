<?php

namespace Waffle;

class Plox
{
    private static bool $hadError = false;

    public static function compile(array $args): void
    {
        if (count($args) > 2) {
            echo "Usage: plox [script]";
            exit(1);
        }

        if (count($args) == 2) {
            self::runFile($args[1]);
            return;
        }

        self::runPrompt();
    }

    protected static function runFile(string $file): void
    {
        $content = file_get_contents(
            filename: $file,
            use_include_path: FILE_USE_INCLUDE_PATH
        );

        self::run($content);

        if (self::$hadError) {
            exit(1);
        }
    }

    protected static function runPrompt(): void
    {
        for(;;) {
            $line = readline(prompt: "plox> ");
            if ($line == "quit") {
                break;
            } elseif (!$line) {
                continue;
            }

            static::run($line);
            self::$hadError = false;
        }
    }

    protected static function run(string $source): void
    {
        $scanner = new Scanner($source);
        $tokens = $scanner->scanTokens();
        $parser = new Parser($tokens);
        $expr = $parser->parse();

        if (self::$hadError) {
            return;
        }

        echo (new AstPrinter())->printExpr($expr);
    }

    public static function error(int $line, string $message): void
    {
        self::report(line: $line, where: "", message: $message);
    }

    private static function report(int $line, string $where, string $message): void
    {
        echo sprintf("[line %d] Error%s: %s\n", $line, $where, $message);
        self::$hadError = true;
    }

    public static function errorOnToken(Token $token, string $message): void
    {
        match($token) {
            TokenType::EOF => self::report($token->line, " at end", $message),
            default => self::report($token->line, " at '{$token->lexeme}'", $message)
        };
    }
}
