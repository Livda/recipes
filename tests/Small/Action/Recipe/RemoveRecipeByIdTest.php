<?php

namespace App\Tests\Small\Action\Recipe;

use App\Action\Recipe\RemoveRecipeById;
use App\Tests\Helper\GetterTestInterface;
use App\Tests\Helper\GetterTestTrait;
use PHPUnit\Framework\TestCase;

class RemoveRecipeByIdTest extends TestCase implements GetterTestInterface
{
    use GetterTestTrait;

    public function init(): RemoveRecipeById
    {
        return new RemoveRecipeById(
            id: 0,
        );
    }

    public function providerGetter(): array
    {
        return [
            'test getter id' => ['id', 0],
        ];
    }
}
