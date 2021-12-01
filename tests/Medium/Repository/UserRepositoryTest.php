<?php

namespace App\Tests\Medium\Repository;

use App\Entity\Recipe;
use App\Entity\User;
use App\Repository\RecipeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserRepositoryTest extends KernelTestCase
{
    private function getRepository(): UserRepository
    {
        $container = static::getContainer();

        return $container->get(UserRepository::class);
    }

    public function testUpdatePassword(): void
    {
        $repository = $this->getRepository();
        $user = new User(
            username: '',
            password: '',
            roles: [],
        );

        $repository->upgradePassword($user, '');

        $this->assertNull(null);
    }

    public function testUpdatePasswordWithException(): void
    {
        $repository = $this->getRepository();

        /** @var PasswordAuthenticatedUserInterface $user */
        $user = $this->createMock(PasswordAuthenticatedUserInterface::class);

        $class = \get_class($user);

        $this->expectException(UnsupportedUserException::class);
        $this->expectExceptionMessage(sprintf('Instances of "%s" are not supported.', $class));

        $repository->upgradePassword($user, '');
    }
}
