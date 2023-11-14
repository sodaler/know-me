<?php

namespace App\Filters\Card;

use App\Filters\Filter;
use Elastic\ScoutDriverPlus\Builders\QueryBuilderInterface;
use Elastic\ScoutDriverPlus\Support\Query;
use Illuminate\Database\Eloquent\Builder;

class ByHigherRating extends Filter
{
    public function handle(): QueryBuilderInterface
    {
        return Query::range()
            ->field('rating')
            ->gt($this->value)
            ->boost(1);
    }
}
