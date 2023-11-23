<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacetsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'skills' => $this->get('skills')['buckets'],
            'category' => $this->get('category')['buckets'],
            'rating' => $this->get('rating')['buckets'],
        ];
    }
}
