<?php

namespace App\Utils\Transitions\CardRequest\Accepted;

use App\Models\CardRequest;
use App\Utils\States\CardRequest\AcceptedState;
use App\Utils\States\CardRequest\InProgressState;
use App\Utils\Transitions\CardRequest\Contracts\Transition;
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
