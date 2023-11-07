<?php

namespace App\Transitions\CardRequest\InProgress;

use App\Enums\Card\CardRequestsStatuses;
use App\Models\CardRequest;
use App\States\CardRequest\CompletedState;
use App\Transitions\CardRequest\Contracts\Transition;
use Exception;

class InProgressToCompletedTransition implements Transition
{
    public function execute(CardRequest $cardRequest): CardRequest
    {
        if ($cardRequest->status !== CardRequestsStatuses::InProgress) {
            throw new Exception('Transition not allowed');
        }

        $cardRequest->status->transitionTo(new CompletedState($cardRequest));

        return $cardRequest;
    }
}
