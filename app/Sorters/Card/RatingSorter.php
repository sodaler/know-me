<?php

namespace App\Sorters\Card;

use App\Sorters\Sorter;
use Laravel\Scout\Builder;

class RatingSorter extends Sorter
{
    function handle(Builder $query): void
    {
        $query->orderBy('rating', $this->sortDirection->value);
    }
}
