<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\Auth\AuthService;
use App\Services\FileService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserService
{
    public function store(array $data, AuthService $authService): array
    {
        try {
            DB::beginTransaction();
            User::create($data);

            $response['data'] = $authService->getTokensByCredentials($data);
            $response['status'] = Response::HTTP_OK;

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            $response['data']['message'] = __('errors.any');
            $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            return $response;
        }
    }

    public function update(array $data, User $user, FileService $fileService): User
    {
        if (isset($data['image'])) {
            $data['image'] = $fileService
                ->saveImage(
                    "avatars/{$user->id}",
                    $data['image']
                );
        }
        $user->updateOrFail($data);

        return $user->fresh();
    }
}
