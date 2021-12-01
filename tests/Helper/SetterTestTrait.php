<?php

namespace App\Tests\Helper;

trait SetterTestTrait
{
    use FunctionNameGeneratorTrait;

    /**
     * @dataProvider providerSetter
     */
    public function testSetter(string $attribute, $value): void
    {
        $object = $this->init();

        $setters = $this->setters($object, $attribute);
        foreach ($setters as $setter) {
            $actual = $object->$setter($value);
            $this->assertSame($object, $actual);
        }
    }
}
