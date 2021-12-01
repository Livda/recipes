<?php

namespace App\Tests\Small\Enum;

use App\Enum\DietEnum;
use PHPUnit\Framework\TestCase;

class DietEnumTest extends TestCase
{
    public function testGetDiets(): void
    {
        $actual = DietEnum::getDiets();

        $this->assertCount(
            expectedCount: 3,
            haystack: $actual,
        );
    }
}
