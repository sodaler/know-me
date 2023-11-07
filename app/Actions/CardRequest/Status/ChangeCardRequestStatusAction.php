<?php

namespace App\Actions\CardRequest\Status;

use App\Enums\Card\CardRequestsStatuses;
use App\Models\CardRequest;
use App\Transitions\CardRequest\AllowedTransitions;
use Illuminate\Support\Facades\DB;

class ChangeCardRequestStatusAction
{
    public function execute(CardRequest $cardRequest, CardRequestsStatuses $nextStatus): CardRequest
    {
        return DB::transaction(function () use ($cardRequest, $nextStatus) {
            $transition = AllowedTransitions::getTransition($cardRequest->status, $nextStatus);

            return $transition->execute($cardRequest);
        });
    }
}
