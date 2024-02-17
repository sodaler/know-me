<?php

namespace App\Enums\Filters\Card;

use App\Utils\Filters\Card\ByCategories;
use App\Utils\Filters\Card\ByHigherRating;
use App\Utils\Filters\Card\BySkills;
use App\Utils\Filters\Filter;

enum FiltersEnum: string
{
    case ByHigherRating = 'by_higher_rating';
    case BySkills = 'by_skills';
    case ByCategories = 'by_categories';

    public function createFilter(mixed $value): Filter
    {
        return match ($this) {
            self::ByHigherRating => new ByHigherRating($value),
            self::BySkills => new BySkills($value),
            self::ByCategories => new ByCategories($value),
        };
    }
}
