<?php

namespace App\Tests\Helper;

interface GetterTestInterface
{
    public function testGetter(string $attribute, $value): void;
}
