<?php

namespace App\Transitions\CardRequest\Pending;

use App\Enums\Card\CardRequestsStatuses;
use App\Models\CardRequest;
use App\States\CardRequest\CancelledState;
use App\Transitions\CardRequest\Contracts\Transition;

class PendingToCancelledTransition implements Transition
{
    public function execute(CardRequest $cardRequest): CardRequest
    {
        if ($cardRequest->status !== CardRequestsStatuses::Pending) {
            throw new \Exception('Transition not allowed');
        }

        $cardRequest->status->transitionTo(new CancelledState($cardRequest));

        return $cardRequest;
    }
}
