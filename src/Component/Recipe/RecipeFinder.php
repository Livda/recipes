<?php

namespace App\Component\Recipe;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Exception;

class RecipeFinder
{
    public function __construct(
        private RecipeRepository $repository,
    ) {
    }

    public function findOneById(int $id): Recipe
    {
        return $this->repository->findOneBy(['id' => $id])
            ?? throw new Exception(sprintf('Recipe %s not found', $id))
        ;
    }
}
