<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $recipe1 = new Recipe(
            name: 'Quiche aux poireaux',
            diet: 'veggie',
            season: 'winter',
            url: 'http://localhost',
        );
        $manager->persist($recipe1);

        $recipe2 = new Recipe(
            name: 'Chili con Carne',
            diet: 'all',
            season: 'all',
            url: 'http://localhost',
        );
        $manager->persist($recipe2);

        $recipe3 = new Recipe(
            name: 'Moussaka',
            diet: 'all',
            season: 'all',
            url: 'http://localhost',
            note: 'Mettre une noix de muscade, bien rincer les aubergines, faire fondre les oignons avant de mettre les tomates.',
        );
        $recipe3->setTags([
            'aubergine',
            'four',
            'boeuf',
        ]);
        $manager->persist($recipe3);

        $manager->flush();
    }
}
