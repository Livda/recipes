<?php

namespace App\Component\Recipe;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;

class RecipeWriter
{
    public function __construct(
        private RecipeRepository $repository,
    ) {
    }

    public function save(Recipe $recipe): Recipe
    {
        $this->repository->genericSave($recipe);

        return $recipe;
    }

    public function remove(Recipe $recipe): void
    {
        $this->repository->genericDelete($recipe);

        return;
    }
}
