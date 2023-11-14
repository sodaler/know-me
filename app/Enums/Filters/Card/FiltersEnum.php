<?php

namespace App\Enums\Filters\Card;

use App\Filters\Card\ByCategories;
use App\Filters\Card\ByHigherRating;
use App\Filters\Card\BySkills;
use App\Filters\Card\SearchByTitle;
use App\Filters\Filter;

enum FiltersEnum: string
{
    case ByHigherRating = 'by_higher_rating';
    case BySkills = 'by_skills';
    case SearchByTitle = 'search_by_title';
    case ByCategories = 'by_categories';

    public function createFilter(mixed $value): Filter
    {
        return match ($this) {
            self::ByHigherRating => new ByHigherRating($value),
            self::BySkills => new BySkills($value),
            self::SearchByTitle => new SearchByTitle($value),
            self::ByCategories => new ByCategories($value),
        };
    }
}
