<?php

namespace App\Utils\Transitions\CardRequest\Created;

use App\Models\CardRequest;
use App\Utils\States\CardRequest\CancelledState;
use App\Utils\States\CardRequest\CreatedState;
use App\Utils\Transitions\CardRequest\Contracts\Transition;
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
