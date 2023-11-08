<?php

namespace App\Http\Resources\CardRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardRequestResource extends JsonResource
{
    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'card_id' => $this->card_id,
            'mentor_id' => $this->mentor_id,
            'student_id' => $this->student_id,
            'status' => $this->status->value(),
        ];
    }
}
