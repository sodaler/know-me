<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\MediableNoteDeleted;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\User\UserResource;
use App\Models\Media;
use App\Models\User;
use App\Services\FileService;
use App\Services\Media\MediaService;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(UpdateRequest $request, User $user, MediaService $mediaService): UserResource
    {
        $mediaService->refreshAvatarFor($user);
        $user->updateOrFail($request->validated());

        return new UserResource($user);
    }

    public function destroy(User $user): JsonResponse
    {
        event(new MediableNoteDeleted($user));
        $user->delete();

        return response()->json([
            'message' => __('messages.success_delete'),
        ]);
    }

    public function indexChats(): AnonymousResourceCollection
    {
        $user = auth()->user();

        return ChatResource::collection($user->allChats());
    }
}
