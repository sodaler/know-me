<?php

namespace App\Actions\Message;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Model;

final class CreateChatsMessage
{
    public static function fromArray(Chat $chat, array $data): Model
    {
        $storeData = array_merge(
            $data,
            [
                'chat_id' => $chat->id,
                'member_id' => $chat->member->id,
                'creator_id' => $chat->creator->id,
            ]
        );

        return $chat->messages()->create($storeData);
    }
}
