<?php

namespace App\Tests\Small\Component\Recipe;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use App\Component\Recipe\RecipeViewer;
use App\Entity\Recipe;

class RecipeViewerTest extends TestCase
{
    public function init(): MockObject|RecipeViewer
    {
        return $this->getMockForTrait(RecipeViewer::class);
    }

    public function testViewOne(): void
    {
        $mock = $this->createConfiguredMock(Recipe::class, [
            'getDiet' => '',
            'getName' => '',
            'getSeason' => '',
            'getTags' => [],
        ]);

        $actual = $this->init()->viewOne($mock);

        $this->assertCount(
            expectedCount: 6,
            haystack: $actual,
        );
    }
}
