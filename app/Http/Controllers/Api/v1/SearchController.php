<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Search\Card\FilterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Filter\GetCardsRequest;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function index(GetCardsRequest $request): Collection
    {
        return FilterAction::execute(
            $request->collect('filters')
        );
    }
}
