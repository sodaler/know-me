<?php

namespace App\Enums\Sorters;

use App\Sorters\Card\RatingSorter;
use App\Sorters\Sorter;

enum SortersEnum: string
{
    case Rating = 'rating';

    public function createSorters(SortDirection $sortDirection): Sorter
    {
        return match ($this) {
          self::Rating => new RatingSorter($sortDirection),
        };
    }
}
