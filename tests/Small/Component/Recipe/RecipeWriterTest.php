<?php

namespace App\Tests\Small\Component\Recipe;

use App\Component\Recipe\RecipeWriter;
use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RecipeWriterTest extends TestCase
{
    private RecipeRepository|MockObject $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(RecipeRepository::class);
    }

    public function init(): RecipeWriter
    {
        return new RecipeWriter(
            repository: $this->repository,
        );
    }

    public function testSave(): void
    {
        /** @var Recipe $mock */
        $mock = $this->createMock(Recipe::class);

        $this->repository
            ->expects($this->once())
            ->method('genericSave')
            ->with($mock)
            ->willReturn($mock)
        ;

        $this->init()->save($mock);
    }

    public function testRemove(): void
    {
        /** @var Recipe $mock */
        $mock = $this->createMock(Recipe::class);

        $this->repository
            ->expects($this->once())
            ->method('genericDelete')
            ->with($mock)
        ;

        $this->init()->remove($mock);
    }
}
