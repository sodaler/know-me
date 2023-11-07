<?php

namespace App\Transitions\CardRequest\Pending;

use App\Models\CardRequest;
use App\States\CardRequest\AcceptedState;
use App\States\CardRequest\PendingState;
use App\Transitions\CardRequest\Contracts\Transition;

class PendingToAcceptedTransition implements Transition
{
    public function execute(CardRequest $cardRequest): CardRequest
    {
        if (!($cardRequest->status instanceof PendingState)) {
            throw new \Exception('Transition not allowed');
        }

        $cardRequest->status->transitionTo(new AcceptedState($cardRequest));

        return $cardRequest;
    }
}
