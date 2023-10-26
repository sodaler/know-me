<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function update(array $data, User $user): bool
    {
        if (isset($data['image'])) {
            $data['image'] = Storage::disk('public')
                ->putFileAs(
                    "/user/{$user->id}",
                    $data['image'],
                    $data['image']->getClientOriginalName()
                );
        }

        return $user->updateOrFail($data);
    }
}