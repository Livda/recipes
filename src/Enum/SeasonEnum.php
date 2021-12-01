<?php

declare(strict_types=1);

namespace App\Enum;

class SeasonEnum
{
    public const ALL_SEASONS = 'all';
    public const AUTUMN = 'autumn';
    public const SPRING = 'spring';
    public const SUMMER = 'summer';
    public const WINTER = 'winter';

    /**
     * @return array<string>
     */
    public static function getSeasons(): array
    {
        return [
            self::WINTER,
            self::AUTUMN,
            self::SUMMER,
            self::SPRING,
            self::ALL_SEASONS,
        ];
    }
}
