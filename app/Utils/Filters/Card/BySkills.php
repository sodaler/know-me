<?php

namespace App\Utils\Filters\Card;

use App\Utils\Filters\Filter;
use Elastic\ScoutDriverPlus\Builders\QueryBuilderInterface;
use Elastic\ScoutDriverPlus\Support\Query;

class BySkills extends Filter
{
    function handle(): QueryBuilderInterface
    {
        return Query::terms()
            ->field('skills_id')
            ->values($this->value)
            ->boost(2);
    }
}
