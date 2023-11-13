<?php

namespace App\Enums\Filters\Card;

use App\Filters\Card\AverageRating;
use App\Filters\Card\MostPopular;
use App\Filters\Filter;

enum FiltersEnum: string
{
    case AverageRating = 'avg_rating';
    case MostPopular = 'most_popular';

    public function createFilter(int $value): Filter
    {
        return match ($this) {
            self::AverageRating => new AverageRating($value),
            self::MostPopular => new MostPopular($value),
        };
    }
}
