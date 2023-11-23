<?php

namespace App\Utils\Transitions\CardRequest\Pending;

use App\Models\CardRequest;
use App\Utils\States\CardRequest\AcceptedState;
use App\Utils\States\CardRequest\PendingState;
use App\Utils\Transitions\CardRequest\Contracts\Transition;
use Exception;

class PendingToAcceptedTransition implements Transition
{
    public function execute(CardRequest $cardRequest): CardRequest
    {
        if (!($cardRequest->status instanceof PendingState)) {
            throw new Exception('Transition not allowed');
        }

        $cardRequest->status->transitionTo(new AcceptedState($cardRequest));

        return $cardRequest;
    }
}
