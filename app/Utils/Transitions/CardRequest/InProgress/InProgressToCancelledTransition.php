<?php

namespace App\Utils\Transitions\CardRequest\InProgress;

use App\Models\CardRequest;
use App\Utils\States\CardRequest\CancelledState;
use App\Utils\States\CardRequest\InProgressState;
use App\Utils\Transitions\CardRequest\Contracts\Transition;
use Exception;

class InProgressToCancelledTransition implements Transition
{
    public function execute(CardRequest $cardRequest): CardRequest
    {
        if (!($cardRequest->status instanceof InProgressState)) {
            throw new Exception('Transition not allowed');
        }

        $cardRequest->status->transitionTo(new CancelledState($cardRequest));

        return $cardRequest;
    }
}
