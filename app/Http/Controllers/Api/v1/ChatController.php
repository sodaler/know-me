<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Chat\CreateChat;
use App\Actions\Message\CreateChatsMessage;
use App\Events\MessageDeleted;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\ChatRequest;
use App\Http\Requests\Message\SendMessageRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Message\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChatController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $chats = Chat::cursorPaginate(10);

        return ChatResource::collection($chats);
    }

    public function show(Chat $chat): ChatResource
    {
        return new ChatResource($chat);
    }

    public function store(ChatRequest $request): JsonResponse
    {
        $chat = CreateChat::fromArray($request->validated());

        return response()->json([
            'message' => __('messages.success_create'),
            'item' => [
                'id' => $chat->id,
            ],
        ]);
    }

    public function sendMessage(SendMessageRequest $request, Chat $chat): JsonResponse
    {
        broadcast(
            new MessageSent(
                $chat,
                CreateChatsMessage::fromArray($chat, $request->validated())
            )
        );

        return response()->json(['status' => __('messages.message_sent')]);
    }

    public function deleteMessage(Chat $chat, Message $message): JsonResponse
    {
        $message->delete();
        broadcast(new MessageDeleted($chat, $message));

        return response()->json(['status' => __('messages.message_deleted')]);
    }

    public function chatMessages(Chat $chat): AnonymousResourceCollection
    {
        return MessageResource::collection($chat->messages);
    }
}
