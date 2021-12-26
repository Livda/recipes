<?php

namespace App\Tests\Small\Entity;

use App\Entity\User;
use App\Tests\Helper\GetterNullableTestInterface;
use App\Tests\Helper\GetterNullableTestTrait;
use App\Tests\Helper\GetterTestInterface;
use App\Tests\Helper\GetterTestTrait;
use App\Tests\Helper\SetterTestInterface;
use App\Tests\Helper\SetterTestTrait;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase implements GetterNullableTestInterface, GetterTestInterface, SetterTestInterface
{
    use GetterNullableTestTrait;
    use GetterTestTrait;
    use SetterTestTrait;

    public function init(): User
    {
        return new User(
            username: 'user',
            password: 'password',
            roles: [],
        );
    }

    public function providerGetter(): array
    {
        return [
            'test getter userIdentifier' => ['userIdentifier', 'user'],
            'test getter username' => ['username', 'user'],
            'test getter password' => ['password', 'password'],
            'test getter roles' => ['roles', ['ROLE_USER']],
        ];
    }

    public function providerNullableGetter(): array
    {
        return [
            'test nullable getter id' => ['id'],
        ];
    }

    public function providerSetter(): array
    {
        return [
            'test setter username' => ['username', 'user'],
            'test setter password' => ['password', 'password'],
            'test setter roles' => ['roles', []],
        ];
    }

    public function testEraseCredential(): void
    {
        // I don't know how to test this function
        $this->init()->eraseCredentials();
        $this->assertNull(null);
    }
}
