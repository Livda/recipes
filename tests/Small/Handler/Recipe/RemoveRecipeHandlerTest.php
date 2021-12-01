<?php

namespace App\Tests\Small\Handler\Recipe;

use App\Action\Recipe\RemoveRecipeById;
use App\Component\Recipe\RecipeFinder;
use App\Component\Recipe\RecipeWriter;
use App\Entity\Recipe;
use App\Handler\Recipe\RemoveRecipeHandler;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RemoveRecipeHandlerTest extends TestCase
{
    private RecipeFinder|MockObject $finder;
    private RecipeWriter|MockObject $writer;

    protected function setUp(): void
    {
        $this->finder = $this->createMock(RecipeFinder::class);
        $this->writer = $this->createMock(RecipeWriter::class);
    }

    public function init(): RemoveRecipeHandler
    {
        return new RemoveRecipeHandler(
            finder: $this->finder,
            writer: $this->writer,
        );
    }

    public function testById(): void
    {
        /** @var RemoveRecipeById $command */
        $command = $this->createMock(RemoveRecipeById::class, [
            'getId' => 0,
        ]);
        $mock = $this->createMock(Recipe::class);

        $this->finder
            ->expects($this->once())
            ->method('findOneById')
            ->with(0)
            ->willReturn($mock)
        ;

        $this->writer
            ->expects($this->once())
            ->method('remove')
            ->with($mock)
        ;

        $this->init()->byId($command);
    }
}
