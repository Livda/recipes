<?php

namespace App\Component\Recipe;

use App\Entity\Recipe;

trait RecipeViewer
{
    public function viewOne(Recipe $recipe): array
    {
        return [
            'diet' => $recipe->getDiet(),
            'id' => $recipe->getId(),
            'name' => $recipe->getName(),
            'note' => $recipe->getNote(),
            'season' => $recipe->getSeason(),
            'tags' => $recipe->getTags(),
        ];
    }
}
