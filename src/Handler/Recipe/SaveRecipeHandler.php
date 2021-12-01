<?php

namespace App\Handler\Recipe;

use App\Action\Recipe\SaveRecipeByForm;
use App\Component\Recipe\RecipeFinder;
use App\Component\Recipe\RecipeWriter;
use App\Entity\Recipe;

class SaveRecipeHandler
{
    public function __construct(
        private RecipeFinder $finder,
        private RecipeWriter $writer,
    ) {
    }

    public function byForm(SaveRecipeByForm $command): Recipe
    {
        $id = $command->getId();
        $recipe = null !== $id
            ? $this->finder->findOneById($id)
            : new Recipe(
                name: $command->getName(),
                diet: $command->getDiet(),
                season: $command->getSeason(),
                url: $command->getUrl(),
                note: $command->getNote(),
            )
        ;

        $recipe->setDiet($command->getDiet());
        $recipe->setName($command->getName());
        $recipe->setNote($command->getNote());
        $recipe->setSeason($command->getSeason());
        $recipe->setUrl($command->getUrl());

        return $this->writer->save($recipe);
    }
}
