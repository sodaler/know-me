<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\FileService;

class UserService
{
    public function __construct(
        private readonly FileService $fileService,
    ) {
    }

    public function update(array $data, User $user): User
    {
        if (isset($data['image'])) {
            $data['image'] = $this->fileService
                ->saveImage(
                    "avatars/{$user->id}",
                    $data['image']
                );
        }
        $user->updateOrFail($data);

        return $user->fresh();
    }
}
