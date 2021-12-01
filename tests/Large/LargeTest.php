<?php

namespace App\Tests\Large;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\Panther\PantherTestCase;

abstract class LargeTest extends PantherTestCase
{
    protected function loginAdmin(): KernelBrowser
    {
        $client = static::createClient();
        $container = static::getContainer();
        $userRepository = $container->get(UserRepository::class);

        $testUser = $userRepository->findOneBy(['username' => 'admin']);
        $client->loginUser($testUser);

        return $client;
    }

    protected function loginUser(): KernelBrowser
    {
        $client = static::createClient();
        $container = static::getContainer();
        $userRepository = $container->get(UserRepository::class);

        $testUser = $userRepository->findOneBy(['username' => 'user']);
        $client->loginUser($testUser);

        return $client;
    }
}
