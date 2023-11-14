<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\Filters\Card\FiltersEnum;
use App\Http\Controllers\Controller;
use App\Models\Card;
use Elastic\ScoutDriverPlus\Support\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function index(Request $request): Collection
    {
        $filters = $request->collect('filters');

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
