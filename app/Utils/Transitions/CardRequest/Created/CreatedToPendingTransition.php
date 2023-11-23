<?php

namespace App\Utils\Transitions\CardRequest\Created;

use App\Models\CardRequest;
use App\Utils\States\CardRequest\CreatedState;
use App\Utils\States\CardRequest\PendingState;
use App\Utils\Transitions\CardRequest\Contracts\Transition;
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
