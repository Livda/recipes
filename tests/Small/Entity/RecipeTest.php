<?php

namespace App\Tests\Small\Entity;

use App\Entity\Recipe;
use App\Tests\Helper\GetterNullableTestInterface;
use App\Tests\Helper\GetterNullableTestTrait;
use App\Tests\Helper\GetterTestInterface;
use App\Tests\Helper\GetterTestTrait;
use App\Tests\Helper\SetterNullableTestInterface;
use App\Tests\Helper\SetterNullableTestTrait;
use App\Tests\Helper\SetterTestInterface;
use App\Tests\Helper\SetterTestTrait;
use PHPUnit\Framework\TestCase;

class RecipeTest extends TestCase implements GetterNullableTestInterface, GetterTestInterface, SetterNullableTestInterface, SetterTestInterface
{
    use GetterNullableTestTrait;
    use GetterTestTrait;
    use SetterNullableTestTrait;
    use SetterTestTrait;

    public function init(): Recipe
    {
        return new Recipe(
            name: 'name',
            diet: 'all',
            season: 'all',
            url: 'url',
        );
    }

    public function providerGetter(): array
    {
        return [
            'test getter diet' => ['diet', 'all'],
            'test getter name' => ['name', 'name'],
            'test getter season' => ['season', 'all'],
            'test getter url' => ['url', 'url'],
            'test getter tags' => ['tags', []],
        ];
    }

    public function providerNullableGetter(): array
    {
        return [
            'test nullable getter id' => ['id'],
            'test nullable getter note' => ['note'],
        ];
    }

    public function providerNullableSetter(): array
    {
        return [
            'test nullable setter note' => ['note'],
        ];
    }

    public function providerSetter(): array
    {
        return [
            'test setter diet' => ['diet', 'all'],
            'test setter name' => ['name', 'name'],
            'test setter note' => ['note', 'note'],
            'test setter season' => ['season', 'all'],
            'test setter url' => ['url', 'url'],
            'test setter tags' => ['tags', []],
        ];
    }
}
