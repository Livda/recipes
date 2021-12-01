<?php

namespace App\Action\Recipe;

class SaveRecipeByForm
{
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
        return $this->diet;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function getSeason(): string
    {
        return $this->season;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
