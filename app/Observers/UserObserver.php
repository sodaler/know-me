<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    public function updated(User $user): void
    {
        if ($user->isDirty('image')) {
            Storage::disk('public')->delete($user->getOriginal('image'));
        }
    }

    public function deleted(User $user): void
    {
        Storage::disk('public')->deleteDirectory("avatars/{$user->id}");
    }
}
