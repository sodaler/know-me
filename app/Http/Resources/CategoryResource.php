<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'skills' => SkillResource::collection($this->whenLoaded('skills')),
            'slug' => $this->slug,
            'rating' => $this->rating,
            'image' => $this->image,
            'image_alt' => $this->image_alt
        ];
    }
}
