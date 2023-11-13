<?php

namespace App\Filters\Card;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class AverageRating extends Filter
{
    function handle(Builder $query): void
    {
        // TODO with related rating
        $query->where('rating', '>=', $this->value);
    }
}
