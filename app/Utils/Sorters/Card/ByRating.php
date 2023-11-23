<?php

namespace App\Utils\Sorters\Card;

use App\Utils\Sorters\Sorter;
use Elastic\ScoutDriverPlus\Builders\SearchParametersBuilder;
use Elastic\ScoutDriverPlus\Paginator;

class ByRating extends Sorter
{
    public function handle(SearchParametersBuilder $builder): Paginator
    {
        return $builder
            ->sort('rating', $this->sortDirection->value)
            ->paginate(10);
    }
}
