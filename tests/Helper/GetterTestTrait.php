<?php

namespace App\Tests\Helper;

trait GetterTestTrait
{
    use FunctionNameGeneratorTrait;

    /**
     * @dataProvider providerGetter
     */
    public function testGetter(string $attribute, $value): void
    {
        $object = $this->init();

        $getters = $this->getters($object, $attribute);
        foreach ($getters as $getter) {
            $this->assertSame($object->$getter(), $value);
        }
    }
}
