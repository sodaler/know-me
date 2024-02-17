<?php

namespace App\Enums\Sorters;

use App\Utils\Sorters\Card\ByRating;
use App\Utils\Sorters\Sorter;

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
