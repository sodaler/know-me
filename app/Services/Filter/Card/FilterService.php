<?php

namespace App\Services\Filter\Card;

use App\Enums\Filters\Card\FiltersEnum;
use App\Http\Resources\Card\FacetsResource;
use App\Http\Resources\Card\FilterResource;
use App\Models\Card;
use Elastic\ScoutDriverPlus\Builders\BoolQueryBuilder;
use Elastic\ScoutDriverPlus\Support\Query;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class FilterService
{
    /**
     * @param ?Collection<string, mixed> $filters
     *
     * @return AnonymousResourceCollection<Card>
     */
    public function filter(
        ?Collection $filters
    ): AnonymousResourceCollection
    {
        $query = $this->getFilterQuery($filters);

        return FilterResource::collection(
            Card::searchQuery($query)->paginate(10)
        );
    }

    /**
     * @param ?Collection<string, mixed> $filters
     *
     * @return FacetsResource<array>
     */
    public function facets(?Collection $filters): FacetsResource
    {
        $query = $this->getAggregationsQuery($filters);

        return new FacetsResource($query);
    }

    /**
     * @param ?Collection<string, mixed> $filters
     *
     * @return BoolQueryBuilder
     */
    private function getFilterQuery(?Collection $filters): BoolQueryBuilder
    {
        $query = Query::bool()->must(Query::matchAll());

        if ($filters->isNotEmpty()) {
            foreach ($filters as $name => $value) {
                $filter = FiltersEnum::from($name)->createFilter($value);

                $query->must($filter->handle());
            }
        }

        return $query;
    }

    /**
     * @param ?Collection<string, mixed> $filters
     *
     * @return Collection<Card>
     */
    private function getAggregationsQuery(?Collection $filters): Collection
    {
        $query = $this->getFilterQuery($filters);

        return Card::searchQuery($query)
            ->aggregate('rating', [
                'range' => [
                    'field' => 'rating',
                    'ranges' => [
                        ['from' => 1],
                        ['from' => 2],
                        ['from' => 3],
                        ['from' => 4],
                        ['from' => 5],
                    ]
                ]
            ])
            ->aggregate('category', [
                'terms' => [
                    'field' => 'category',
                ]
            ])
            ->aggregate('skills', [
                'terms' => [
                    'field' => 'skills_id'
                ]
            ])
            ->size(0)
            ->minScore(0.5)
            ->execute()
            ->aggregations();
    }
}
