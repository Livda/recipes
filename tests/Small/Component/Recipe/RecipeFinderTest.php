<?php

namespace App\Tests\Small\Component\Recipe;

use App\Component\Recipe\RecipeFinder;
use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RecipeFinderTest extends TestCase
{
    private RecipeRepository|MockObject $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(RecipeRepository::class);
    }

    public function init(): RecipeFinder
    {
        return new RecipeFinder(
            repository: $this->repository,
        );
    }

    public function testOneByIdWithException(): void
    {
        $this->repository
            ->expects($this->once())
            ->method('findOneBy')
            ->with(['id' => 0])
            ->willReturn(null)
        ;

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Recipe 0 not found');

        $this->init()->findOneById(0);
    }

    public function testOneByIdWithoutException(): void
    {
        $mock = $this->createMock(Recipe::class);
        $this->repository
            ->expects($this->once())
            ->method('findOneBy')
            ->with(['id' => 0])
            ->willReturn($mock)
        ;

        $actual = $this->init()->findOneById(0);

        $this->assertSame(
            expected: $mock,
            actual: $actual,
        );
    }
}
