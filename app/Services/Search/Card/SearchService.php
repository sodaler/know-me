<?php

namespace App\Services\Search\Card;

use App\Http\Resources\Card\SearchResource;
use App\Http\Resources\Card\SuggestionsResource;
use App\Models\Card;
use Elastic\ScoutDriverPlus\Builders\MatchQueryBuilder;
use Elastic\ScoutDriverPlus\Builders\SearchParametersBuilder;
use Elastic\ScoutDriverPlus\Support\Query;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchService
{
    /**
     * @param ?string $searchQuery
     *
     * @return AnonymousResourceCollection<Card>
     */
    public function search(?string $searchQuery): AnonymousResourceCollection
    {
        $query = $this->searchQuery($searchQuery);

        return SearchResource::collection(Card::searchQuery($query)->paginate(10));
    }

    /**
     * @param ?string $searchQuery
     *
     * @return SuggestionsResource<Card>
     */
    public function suggest(?string $searchQuery): SuggestionsResource
    {
        $query = $this->suggestQuery($searchQuery);

        return new SuggestionsResource($query->paginate(10)->suggestions());
    }

    private function suggestQuery(?string $text): SearchParametersBuilder
    {
        return Card::searchQuery(Query::matchNone())
            ->suggest('title_suggest', [
                'text' => $text,
                'term' => [
                    'field' => 'title',
                ]
            ]);
    }

    private function searchQuery(?string $searchQuery): MatchQueryBuilder
    {
        return Query::match()
            ->field('title')
            ->query($searchQuery)
            ->fuzziness('AUTO')
            ->boost(4);
    }
}
