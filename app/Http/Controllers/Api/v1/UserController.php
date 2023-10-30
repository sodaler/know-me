<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function chats(): AnonymousResourceCollection
    {
        $user = auth()->user();

        return ChatResource::collection($user->allChats());
    }
}
