<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\FileService;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function __construct(
        private readonly FileService $fileService,
    ) {
    }

    public function update(array $data, User $user): string
    {
        if (isset($data['image'])) {
            try {
                $data['image'] = $this->fileService
                    ->saveImage(
                        "avatars/{$user->id}",
                        $data['image']
                    );
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        return $user->updateOrFail($data)
            ? __('messages.success_update')
            : __('errors.fail_update');
    }
}