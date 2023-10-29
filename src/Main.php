<?php

namespace Waffle;

class Main
{
    public function compile(array $args): void
    {
        if ( count($args) > 2) {
            echo "Usage: jlox [script]";
            return;
        }

        if (count($args) == 2) {
            $this->runFile($args[1]);
            return;
        }

        $this->runPrompt();
    }

    protected function runFile(string $file): void
    {
        // TODO: read the file contents and pass them to run
    }

    protected function runPrompt(): void
    {
        // TODO: read user input from cli and pass them to run
    }

    protected function run(): void
    {
        // TODO: print tokens from scanner
    }
}