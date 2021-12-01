<?php

namespace App\Tests\Helper;

trait GetterNullableTestTrait
{
    use FunctionNameGeneratorTrait;

    /**
     * @dataProvider providerNullableGetter
     */
    public function testNullableGetter(string $attribute): void
    {
        $object = $this->init();

        $getters = $this->getters($object, $attribute);
        foreach ($getters as $getter) {
            $this->assertNull($object->$getter());
        }
    }
}
