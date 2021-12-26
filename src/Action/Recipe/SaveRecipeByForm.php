<?php

namespace App\Action\Recipe;

use App\Service\StringHandler;

class SaveRecipeByForm
{
    use StringHandler;

    public function __construct(
        private string $name,
        private string $diet,
        private string $season,
        private string $url,
        private ?string $note = null,
        private ?int $id = null,
    ) {
    }

    public function getDiet(): string
    {
        return trim($this->diet);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return trim($this->name);
    }

    public function getNote(): ?string
    {
        return $this->nullable($this->note);
    }

    public function getSeason(): string
    {
        return trim($this->season);
    }

    public function getUrl(): string
    {
        return trim($this->url);
    }
}
