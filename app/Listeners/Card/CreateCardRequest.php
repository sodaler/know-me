<?php

namespace App\Listeners\Card;

use App\Events\Card\CardCreated;

class CreateCardRequest
{
    public function handle(CardCreated $event): void
    {
        $card = $event->card;

        $card->request()->create([
            'card_id' => $card->id,
            'mentor_id' => $card->user_id
        ]);
    }
}
