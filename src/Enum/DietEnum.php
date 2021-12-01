<?php

declare(strict_types=1);

namespace App\Enum;

class DietEnum
{
    public const ALL = 'all';
    public const VEGAN = 'vegan';
    public const VEGGIE = 'veggie';

    /**
     * @return array<string>
     */
    public static function getDiets(): array
    {
        return [
            self::ALL,
            self::VEGGIE,
            self::VEGAN,
        ];
    }
}
