<?php

namespace App\Enums\Card;

use App\Models\CardRequest;
use App\States\CardRequest\AcceptedState;
use App\States\CardRequest\CancelledState;
use App\States\CardRequest\State;
use App\States\CardRequest\CompletedState;
use App\States\CardRequest\CreatedState;
use App\States\CardRequest\InProgressState;
use App\States\CardRequest\PendingState;

enum CardRequestsStatuses: string
{
    case Created = 'created';
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Canceled = 'canceled';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function createState(CardRequest $cardRequest): State
    {
        return match ($this) {
            CardRequestsStatuses::Created => new CreatedState($cardRequest),
            CardRequestsStatuses::Pending => new PendingState($cardRequest),
            CardRequestsStatuses::Accepted => new AcceptedState($cardRequest),
            CardRequestsStatuses::Canceled => new CancelledState($cardRequest),
            CardRequestsStatuses::InProgress => new InProgressState($cardRequest),
            CardRequestsStatuses::Completed => new CompletedState($cardRequest),
        };
    }
}
