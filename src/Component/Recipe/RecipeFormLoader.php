<?php

namespace App\Component\Recipe;

use App\Enum\DietEnum;
use App\Enum\SeasonEnum;

class RecipeFormLoader
{
    public function initialize(array $entityData): array
    {
        return array_merge($entityData, [
            'dietList' => DietEnum::ALL,
            'seasonList' => SeasonEnum::ALL_SEASONS,
        ]);
    }
}
