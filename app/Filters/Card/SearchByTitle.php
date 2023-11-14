<?php

namespace App\Filters\Card;

use App\Filters\Filter;
use Elastic\ScoutDriverPlus\Builders\QueryBuilderInterface;
use Elastic\ScoutDriverPlus\Support\Query;

class SearchByTitle extends Filter
{
    function handle(): QueryBuilderInterface
    {
        return Query::match()
            ->field('title')
            ->query($this->value)
            ->fuzziness('AUTO')
            ->boost(3);
    }
}
