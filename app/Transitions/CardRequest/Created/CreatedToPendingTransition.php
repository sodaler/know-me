<?php

namespace App\Transitions\CardRequest\Created;

use App\Models\CardRequest;
use App\States\CardRequest\CreatedState;
use App\States\CardRequest\PendingState;
use App\Transitions\CardRequest\Contracts\Transition;
use Exception;

class CreatedToPendingTransition implements Transition
{
    public function execute(CardRequest $cardRequest): CardRequest
    {
        if (!($cardRequest->status instanceof CreatedState)) {
            throw new Exception('Transition not allowed');
        }

        $cardRequest->status->transitionTo(new PendingState($cardRequest));

        return $cardRequest;
    }
}
