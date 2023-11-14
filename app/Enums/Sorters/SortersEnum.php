<?php

namespace App\Enums\Sorters;

use App\Sorters\Card\ByRating;
use App\Sorters\Sorter;

enum SortersEnum: string
{
    case ByRating = 'by_rating';

    public function createSorters(SortDirection $sortDirection): Sorter
    {
        return match ($this) {
          self::ByRating => new ByRating($sortDirection),
        };
    }
}
