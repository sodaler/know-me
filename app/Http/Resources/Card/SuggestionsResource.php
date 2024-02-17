<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuggestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $titleSuggest = $this->resource->get('title_suggest')->first();

        return [
            'text' => $titleSuggest->text(),
            'options' => $titleSuggest->options(),
        ];
    }
}
