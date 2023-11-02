<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(UpdateRequest $request, User $user, UserService $userService): UserResource
    {
        return new UserResource(
            $userService->update($request->validated(), $user)
        );
    }

    public function destroy(User $user): JsonResponse
    {
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
