<?php

namespace Waffle;

class Plox
{
    public function compile(array $args): void
    {
        if ( count($args) > 2) {
            echo "Usage: plox [script]";
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
        $content = file_get_contents(
            filename: $file,
            use_include_path: FILE_USE_INCLUDE_PATH
        );

        $this->run($content);
    }

    protected function runPrompt(): void
    {
        for(;;) {
            if ($contents = readline(prompt: "> ")) {
                break;
            }

            $this->run($contents);
        }
    }

    protected function run(string $contents): void
    {
        // TODO: print tokens from scanner
        echo "$contents \n"; # testing
    }
}