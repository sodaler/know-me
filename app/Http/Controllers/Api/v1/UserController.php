<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Chat\ChatResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ) {}

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(UpdateRequest $request, User $user): JsonResponse
    {
        return response()->json([
            'message' => $this->userService->update($request->validated(), $user),
        ]);
    }

    public function destroy(User $user): JsonResponse
    {
        return response()->json([$user->delete()]);
    }

    public function indexChats(): AnonymousResourceCollection
    {
        $user = auth()->user();

        return ChatResource::collection($user->allChats());
    }
}
