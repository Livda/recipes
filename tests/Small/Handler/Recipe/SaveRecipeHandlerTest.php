<?php

namespace App\Tests\Small\Handler\Recipe;

use App\Action\Recipe\SaveRecipeByForm;
use App\Component\Recipe\RecipeFinder;
use App\Component\Recipe\RecipeWriter;
use App\Entity\Recipe;
use App\Handler\Recipe\SaveRecipeHandler;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SaveRecipeHandlerTest extends TestCase
{
    private RecipeFinder|MockObject $finder;
    private RecipeWriter|MockObject $writer;

    protected function setUp(): void
    {
        $this->finder = $this->createMock(RecipeFinder::class);
        $this->writer = $this->createMock(RecipeWriter::class);
    }

    public function init(): SaveRecipeHandler
    {
        return new SaveRecipeHandler(
            finder: $this->finder,
            writer: $this->writer,
        );
    }

    public function testByFormForNewRecipe(): void
    {
        /** @var SaveRecipeByForm $command */
        $command = $this->createConfiguredMock(SaveRecipeByForm::class, [
            'getDiet' => '',
            'getName' => '',
            'getSeason' => '',
            'getUrl' => '',
        ]);

        $this->writer
            ->expects($this->once())
            ->method('save')
        ;

        $actual = $this->init()->byForm($command);

        $this->assertInstanceOf(
            expected: Recipe::class,
            actual: $actual,
        );
    }

    public function testByFormForOldRecipe(): void
    {
        /** @var SaveRecipeByForm $command */
        $command = $this->createConfiguredMock(SaveRecipeByForm::class, [
            'getDiet' => '',
            'getId' => 0,
            'getName' => '',
            'getSeason' => '',
            'getUrl' => '',
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
            ->method('save')
        ;

        $actual = $this->init()->byForm($command);

        $this->assertInstanceOf(
            expected: Recipe::class,
            actual: $actual,
        );
    }
}
