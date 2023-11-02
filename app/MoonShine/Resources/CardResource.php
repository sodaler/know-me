<?php

namespace App\MoonShine\Resources;

use App\Models\Card;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Actions\FiltersAction;
use MoonShine\Decorations\Block;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\BelongsToMany;
use MoonShine\Fields\ID;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;

class CardResource extends Resource
{
    public static string $model = Card::class;

    public static string $title = 'Cards';

    public static int $itemsPerPage = 10;

    public static string $orderField = 'id';

    public static array $with = ['categories', 'skills', 'user'];

    public function fields(): array
    {
        return [
            Block::make('form-container', [
                ID::make()->sortable(),
                Text::make('Title'),
                Text::make('Description')->hideOnIndex(),
                BelongsToMany::make('Skills', 'skills', 'title')
                    ->inLine(separator: ' ', badge: true)->select(),
                BelongsToMany::make('Categories', 'categories', 'title')
                    ->inLine(separator: ' ', badge: true)->select(),
                BelongsTo::make('User', 'user', 'name'),
                Number::make('rating', 'rating'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
