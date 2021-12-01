<?php

namespace App\Handler\Recipe;

use App\Action\Recipe\RemoveRecipeById;
use App\Component\Recipe\RecipeFinder;
use App\Component\Recipe\RecipeWriter;

class RemoveRecipeHandler
{
    public function __construct(
        private RecipeFinder $finder,
        private RecipeWriter $writer,
    ) {
    }

    public function byId(RemoveRecipeById $command): void
    {
        $this->writer->remove($this->finder->findOneById($command->getId()));
    }
}
