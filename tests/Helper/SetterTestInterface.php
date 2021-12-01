<?php

namespace App\Tests\Helper;

interface SetterTestInterface
{
    public function testSetter(string $attribute, $value): void;
}
