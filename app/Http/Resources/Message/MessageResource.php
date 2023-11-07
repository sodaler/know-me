<?php

namespace App\Http\Resources\Message;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'content' => $this->content,
            'is_current_user_creator' => $this->isCurrentCreator(),
            'dispatch_time' => $this->created_at->diffForHumans(),
        ];
    }

    protected function isCurrentCreator(): bool
    {
        $currentUserId = auth()->user()->getAuthIdentifier();

        return $this->chat->creator_id === $currentUserId;
    }
}
