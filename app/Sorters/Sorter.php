<?php

namespace App\Sorters;

use App\Enums\Sorters\SortDirection;
use Laravel\Scout\Builder;

abstract class Sorter
{
    public function __construct(
        protected SortDirection $sortDirection
    )
    {
    }

    abstract function handle(Builder $query): void;
}
