<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Waffle\Scanner;

class ScannerTest extends TestCase
{
    private Scanner $scanner;

    /** @test */
    public function it_expects_single_token_when_source_is_empty(): void
    {
        $this->scanner = new Scanner('');

        $tokens = $this->scanner->scanTokens();

        $this->assertCount(
            1,
            $tokens,
            "Expected a single token"
        );
    }
}
