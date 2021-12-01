<?php

namespace App\Tests\Helper;

trait SetterNullableTestTrait
{
    use FunctionNameGeneratorTrait;

    /**
     * @dataProvider providerNullableSetter
     */
    public function testNullableSetter(string $attribute): void
    {
        $object = $this->init();

        $setters = $this->setters($object, $attribute);
        foreach ($setters as $setter) {
            $actual = $object->$setter(null);
            $this->assertSame($object, $actual);
        }
    }
}
