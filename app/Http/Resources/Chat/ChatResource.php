<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'last_message' => $this?->messages->last()->content,
            'last_message_time_sent' => $this?->messages->last()->created_at->diffForHumans(),
            'title' => $this->getCurrentTitle(),
        ];
    }

    protected function getCurrentTitle(): string
    {
        return auth()->user()->name === $this->creator_name
            ? $this->member_name
            : $this->creator_name;
    }
}
