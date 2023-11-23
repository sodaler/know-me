<?php

namespace App\Actions\CardRequest\Status;

use App\Enums\Card\CardRequestsStatuses;
use App\Models\CardRequest;
use App\Utils\Transitions\CardRequest\AllowedTransitions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class ChangeCardRequestStatusAction
{
    public static function execute(CardRequest|Model $cardRequest, CardRequestsStatuses $nextStatus): CardRequest
    {
        return DB::transaction(function () use ($cardRequest, $nextStatus) {
            $transition = AllowedTransitions::getTransition($cardRequest->status, $nextStatus);

            return $transition->execute($cardRequest);
        });
    }
}
