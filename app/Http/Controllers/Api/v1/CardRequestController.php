<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\CardRequest\Status\ChangeCardRequestStatusAction;
use App\Enums\Card\CardRequestsStatuses;
use App\Http\Controllers\Controller;
use App\Http\Resources\CardRequest\CardRequestResource;
use App\Models\Card;
use App\Models\CardRequest;

class CardRequestController extends Controller
{
    public function send(Card $card): CardRequestResource
    {
        return $this->updateStatus($card->request, CardRequestsStatuses::Pending);
    }

    public function accept(Card $card): CardRequestResource
    {
        return $this->updateStatus($card->request, CardRequestsStatuses::Accepted);
    }

    public function cancel(Card $card): CardRequestResource
    {
        return $this->updateStatus($card->request, CardRequestsStatuses::Canceled);
    }

    public function complete(Card $card): CardRequestResource
    {
        return $this->updateStatus($card->request, CardRequestsStatuses::Completed);
    }

    public function inProgress(Card $card): CardRequestResource
    {
        return $this->updateStatus($card->request, CardRequestsStatuses::InProgress);
    }

    private function updateStatus(CardRequest $cardRequest, CardRequestsStatuses $nextStatus): CardRequestResource
    {
        ChangeCardRequestStatusAction::execute($cardRequest, $nextStatus);

        return new CardRequestResource($cardRequest);
    }
}
