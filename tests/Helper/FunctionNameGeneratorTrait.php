<?php

namespace App\Tests\Helper;

trait FunctionNameGeneratorTrait
{
    private function functionsForPrefixes(object $object, string $attribute, array $prefixes): array
    {
        $methods = array_map(
            callback: fn (string $prefix) => $prefix.ucfirst($attribute),
            array: $prefixes,
        );

        return array_filter(
            array: $methods,
            callback: fn (string $method) => method_exists($object, $method),
        );
    }

    public function getters(object $object, string $attribute): array
    {
        $prefixes = ['get', 'has', 'is'];

        return $this->functionsForPrefixes(
            object: $object,
            attribute: $attribute,
            prefixes: $prefixes,
        );
    }

    public function setters(object $object, string $attribute): array
    {
        $prefixes = ['add', 'set', 'remove'];

        return $this->functionsForPrefixes(
            object: $object,
            attribute: $attribute,
            prefixes: $prefixes,
        );
    }
}
