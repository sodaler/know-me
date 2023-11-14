<?php

namespace App\Filters\Card;

use App\Filters\Filter;
use Elastic\ScoutDriverPlus\Builders\QueryBuilderInterface;
use Elastic\ScoutDriverPlus\Support\Query;

class BySkills extends Filter
{
    function handle(): QueryBuilderInterface
    {
        return Query::terms()
            ->field('skills')
            ->values($this->value)
            ->boost(2);
    }
}
