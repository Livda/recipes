<?php

namespace App\Tests\Small\Action\Recipe;

use App\Action\Recipe\SaveRecipeByForm;
use App\Tests\Helper\GetterNullableTestInterface;
use App\Tests\Helper\GetterNullableTestTrait;
use App\Tests\Helper\GetterTestInterface;
use App\Tests\Helper\GetterTestTrait;
use PHPUnit\Framework\TestCase;

class SaveRecipeByFormTest extends TestCase implements GetterNullableTestInterface, GetterTestInterface
{
    use GetterNullableTestTrait;
    use GetterTestTrait;

    public function init(): SaveRecipeByForm
    {
        return new SaveRecipeByForm(
            name: '',
            diet: '',
            season: '',
            url: '',
        );
    }

    public function providerGetter(): array
    {
        return [
            'test getter diet' => ['diet', ''],
            'test getter name' => ['name', ''],
            'test getter season' => ['season', ''],
            'test getter url' => ['url', ''],
        ];
    }

    public function providerNullableGetter(): array
    {
        return [
            'test nullable getter id' => ['id'],
            'test nullable getter note' => ['note'],
        ];
    }
}
