<?php

namespace App\Transitions\CardRequest\Created;

use App\Models\CardRequest;
use App\States\CardRequest\CancelledState;
use App\States\CardRequest\CreatedState;
use App\Transitions\CardRequest\Contracts\Transition;
use Exception;

class CreatedToCancelledTransition implements Transition
{
    public function execute(CardRequest $cardRequest): CardRequest
    {
        if (!($cardRequest->status instanceof CreatedState)) {
            throw new Exception('Transition not allowed');
        }

        $cardRequest->status->transitionTo(new CancelledState($cardRequest));

        return $cardRequest;
    }
}
