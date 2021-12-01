<?php

namespace App\Tests\Medium\Repository;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RecipeRepositoryTest extends KernelTestCase
{
    private function getRecipe(): Recipe
    {
        return new Recipe(
            name: 'name',
            diet: 'all',
            season: 'all',
            url: 'http://localhost',
        );
    }

    private function getRepository(): RecipeRepository
    {
        $container = static::getContainer();

        return $container->get(RecipeRepository::class);
    }

    public function testSave(): void
    {
        self::bootKernel();

        $recipe = $this->getRepository()->genericSave($this->getRecipe());

        $this->assertNotNull($recipe->getId());
    }

    public function testDelete(): void
    {
        self::bootKernel();

        $recipe = $this->getRecipe();
        $manager = static::getContainer()->get(EntityManagerInterface::class);
        $manager->persist($recipe);
        $manager->flush();
        $id = $recipe->getId();

        $repository = $this->getRepository();
        $repository->genericDelete($recipe);

        $this->assertNull($repository->findOneBy(['id' => $id]));
    }
}
