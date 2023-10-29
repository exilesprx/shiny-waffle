<?php

namespace Waffle;

class Scanner
{
    public function __construct(
        private string $source
    )
    {
    }

    public function scanTokens(): array
    {
        return [];
    }
}