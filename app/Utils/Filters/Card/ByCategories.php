<?php

namespace App\Utils\Filters\Card;

use App\Utils\Filters\Filter;
use Elastic\ScoutDriverPlus\Builders\QueryBuilderInterface;
use Elastic\ScoutDriverPlus\Support\Query;

class ByCategories extends Filter
{
    function handle(): QueryBuilderInterface
    {
        return Query::term()
            ->field('category')
            ->value($this->value);
    }
}
