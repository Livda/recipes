<?php

namespace App\Tests\Small\Enum;

use App\Enum\SeasonEnum;
use PHPUnit\Framework\TestCase;

class SeasonEnumTest extends TestCase
{
    public function testGetSeasons(): void
    {
        $actual = SeasonEnum::getSeasons();

        $this->assertCount(
            expectedCount: 5,
            haystack: $actual,
        );
    }
}
