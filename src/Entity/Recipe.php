<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
#[ORM\Table(name: 'app_recipe')]
class Recipe
{
    #[Assert\Choice(callback: ['App\Enum\DietEnum', 'getDiets'])]
    #[ORM\Column(length: 255, type: Types::STRING)]
    private string $diet;

    #[ORM\Id, ORM\GeneratedValue(strategy: 'AUTO'), ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[Assert\NotBlank(normalizer: 'trim')]
    #[ORM\Column(type: Types::STRING)]
    private string $name;

    #[ORM\Column(nullable: true, type: Types::STRING)]
    private ?string $note = null;

    #[Assert\Choice(callback: ['App\Enum\SeasonEnum', 'getSeasons'])]
    #[ORM\Column(length: 255, type: Types::STRING)]
    private string $season;

    #[ORM\Column(type: Types::JSON)]
    private array $tags = [];

    #[Assert\NotBlank(normalizer: 'trim')]
    #[ORM\Column(type: Types::TEXT)]
    private string $url;

    public function __construct(
        string $name,
        string $diet,
        string $season,
        string $url,
        ?string $note = null,
    ) {
        $this->diet = $diet;
        $this->name = $name;
        $this->note = $note;
        $this->season = $season;
        $this->url = $url;
    }

    public function getDiet(): string
    {
        return $this->diet;
    }

    public function setDiet(string $diet): self
    {
        $this->diet = $diet;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getSeason(): string
    {
        return $this->season;
    }

    public function setSeason(string $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
