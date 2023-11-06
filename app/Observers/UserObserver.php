<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    public function updated(User $user): void
    {
        if ($user->isDirty('image')) {
            Storage::disk('public')->delete($user->getOriginal('image'));
        }
    }

    //TODO DELETE THIS OBSERVATOR AND HIS DIRTY METHOD
    //Need to EVENT for delete
    public function deleted(User $user): void
    {
        Storage::disk('public')->deleteDirectory("avatars/{$user->id}");
    }
}
