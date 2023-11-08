<?php

namespace App\Transitions\CardRequest\Accepted;

use App\Models\CardRequest;
use App\States\CardRequest\AcceptedState;
use App\States\CardRequest\InProgressState;
use App\Transitions\CardRequest\Contracts\Transition;
use Exception;

class AcceptedToInProgressTransition implements Transition
{
    public function execute(CardRequest $cardRequest): CardRequest
    {
        if (!($cardRequest->status instanceof AcceptedState)) {
            throw new Exception('Transition not allowed');
        }

        $cardRequest->status->transitionTo(new InProgressState($cardRequest));

        return $cardRequest;
    }
}
