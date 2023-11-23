<?php

namespace App\Utils\Filters\Card;

use App\Utils\Filters\Filter;
use Elastic\ScoutDriverPlus\Builders\QueryBuilderInterface;
use Elastic\ScoutDriverPlus\Support\Query;

class ByHigherRating extends Filter
{
    public function handle(): QueryBuilderInterface
    {
        return Query::range()
            ->field('rating')
            ->gte($this->value)
            ->boost(1);
    }
}
