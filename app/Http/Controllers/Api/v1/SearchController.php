<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Card\SearchRequest;
use App\Http\Resources\Card\SuggestionsResource;
use App\Models\Card;
use App\Services\Search\Card\SearchService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{
    /**
     * @param SearchRequest<string> $request
     * @param SearchService $service
     *
     * @return AnonymousResourceCollection<Card>
     */
    public function search(SearchRequest $request, SearchService $service): AnonymousResourceCollection
    {
        $requestData = $request->get('search');

        return $service->search($requestData);
    }

    /**
     * @param SearchRequest<string> $request
     * @param SearchService $service
     *
     * @return SuggestionsResource<array>
     */
    public function suggest(SearchRequest $request, SearchService $service): SuggestionsResource
    {
        $requestData = $request->get('search');

        return $service->suggest($requestData);
    }
}
