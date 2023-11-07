<?php

namespace App\Actions\Chat;

use App\Models\Chat;
use App\Models\User;

final class CreateChat
{
    public static function fromArray(array $data): Chat
    {
        $creator = auth()->user();

        $storeData = array_merge(
            $data,
            [
                'member_name' => User::find($data['member_id'])->name,
                'creator_name' => $creator->name,
                'creator_id' => $creator->getAuthIdentifier(),
            ]
        );

        return Chat::create($storeData);
    }
}
