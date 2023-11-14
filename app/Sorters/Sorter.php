<?php

namespace App\Sorters;

use App\Enums\Sorters\SortDirection;
use Elastic\ScoutDriverPlus\Builders\SearchParametersBuilder;
use Elastic\ScoutDriverPlus\Paginator;

abstract class Sorter
{
    public function __construct(
        protected SortDirection $sortDirection
    ) {}

    abstract function handle(SearchParametersBuilder $builder): Paginator;
}
