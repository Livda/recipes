<?php

namespace App\Action\Recipe;

class RemoveRecipeById
{
    public function __construct(
        private int $id,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
