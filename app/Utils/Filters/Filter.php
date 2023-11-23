<?php

namespace App\Utils\Filters;

use Elastic\ScoutDriverPlus\Builders\QueryBuilderInterface;

abstract class Filter
{
    public function __construct(
        protected readonly mixed $value
    ) {}

    abstract function handle(): QueryBuilderInterface;
}
