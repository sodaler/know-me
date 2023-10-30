<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    public function updated(User $user): void
    {
        //
    }

    public function deleted(User $user): void
    {
        Storage::disk('public')->deleteDirectory("user/{$user->id}");
    }
}
