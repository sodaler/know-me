<?php

namespace App\Actions\Search\Card;

use App\Enums\Filters\Card\FiltersEnum;
use App\Models\Card;
use Elastic\ScoutDriverPlus\Support\Query;
use Illuminate\Support\Collection;

final class FilterAction
{
    /**
     * @param Collection<string, mixed> $filters
     * @return Collection<Card>
     */
    public static function execute(
        Collection $filters
    ): Collection
    {
        $query = Query::bool();

        foreach ($filters as $name => $value) {
            $filter = FiltersEnum::from($name)->createFilter($value);

            $query->should($filter->handle());
        }

        return Card::searchQuery($query)
            ->paginate(10)
            ->models();
    }
}
