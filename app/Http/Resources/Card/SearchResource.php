<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $model = $this->resource->model();

        return [
            'id' => $model->id,
            'title' => $model->title,
            'description' => $model->description,
            'image' => $model->image,
            'rating' => $model->rating,
            'alt' => $model->alt,
            'slug' => $model->slug,
            'user_id' => $model->user_id,
            'category_id' => $model->category_id,
            'created_at' => $model->created_at,
        ];
    }
}
