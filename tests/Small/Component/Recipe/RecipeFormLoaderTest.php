<?php

namespace App\Tests\Small\Component\Recipe;

use App\Component\Recipe\RecipeFormLoader;
use PHPUnit\Framework\TestCase;

class RecipeFormLoaderTest extends TestCase
{
    public function init(): RecipeFormLoader
    {
        return new RecipeFormLoader();
    }

    public function testInitialize(): void
    {
        $actual = $this->init()->initialize([]);

        $this->assertCount(
            expectedCount: 2,
            haystack: $actual,
        );
    }
}
