<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;

use MoonShine\Decorations\Block;
use MoonShine\Fields\BelongsToMany;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class SkillResource extends Resource
{
	public static string $model = Skill::class;

	public static string $title = 'Skills';

    public static int $itemsPerPage = 10;

    public static string $orderField = 'id';

    public static array $with = ['categories'];

	public function fields(): array
	{
		return [
            Block::make('form-container', [
                ID::make()->sortable(),
                Text::make('Title'),
                Text::make('Description')->hideOnIndex(),
                BelongsToMany::make('Categories', 'categories', 'title')
                    ->inLine(separator: ' ', badge: true)
            ])
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
