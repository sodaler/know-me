<?php

namespace App\Transitions\CardRequest\Pending;

use App\Models\CardRequest;
use App\States\CardRequest\CancelledState;
use App\States\CardRequest\PendingState;
use App\Transitions\CardRequest\Contracts\Transition;
use Exception;

class PendingToCancelledTransition implements Transition
{
    public function execute(CardRequest $cardRequest): CardRequest
    {
        if (!($cardRequest->status instanceof PendingState)) {
            throw new Exception('Transition not allowed');
        }

        $cardRequest->status->transitionTo(new CancelledState($cardRequest));

        return $cardRequest;
    }
}
