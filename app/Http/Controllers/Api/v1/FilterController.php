<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Card\FilterRequest;
use App\Http\Resources\Card\FacetsResource;
use App\Models\Card;
use App\Services\Filter\Card\FilterService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FilterController extends Controller
{
    /**
     * @param FilterRequest<array> $request
     * @param FilterService $service
     *
     * @return AnonymousResourceCollection<Card>
     */
    public function filter(FilterRequest $request, FilterService $service): AnonymousResourceCollection
    {
        $requestData = $request->validated()->collect('filters');

        return $service->filter($requestData);
    }

    /**
     * @param FilterRequest<array> $request
     * @param FilterService $service
     *
     * @return FacetsResource<Card>
     */
    public function facets(FilterRequest $request, FilterService $service): FacetsResource
    {
        $requestData = $request->validated()->collect('filters');

        return $service->facets($requestData);
    }
}
