<?php

namespace App\Broadcasting;

class ChatChannel
{
    /**
     * Authenticate the user's access to the channel.
     */
    public function join(): array|bool
    {
        return auth()->check();
    }
}
