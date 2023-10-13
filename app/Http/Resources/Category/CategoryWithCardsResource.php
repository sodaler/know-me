<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Card\CardResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryWithCardsResource extends JsonResource
{
    public static $wrap = 'cards';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cards' => CardResource::collection($this->whenLoaded('cards')),
        ];
    }
}
