<?php

namespace App\Transitions\CardRequest;

use App\Enums\Card\CardRequestsStatuses;
use App\States\CardRequest\State;
use App\Transitions\CardRequest\Accepted\AcceptedToCancelledTransition;
use App\Transitions\CardRequest\Accepted\AcceptedToInProgressTransition;
use App\Transitions\CardRequest\Contracts\Transition;
use App\Transitions\CardRequest\Created\CreatedToCancelledTransition;
use App\Transitions\CardRequest\Created\CreatedToPendingTransition;
use App\Transitions\CardRequest\InProgress\InProgressToCancelledTransition;
use App\Transitions\CardRequest\InProgress\InProgressToCompletedTransition;
use App\Transitions\CardRequest\Pending\PendingToAcceptedTransition;
use App\Transitions\CardRequest\Pending\PendingToCancelledTransition;
use InvalidArgumentException;

abstract class AllowedTransitions
{
    public const ALL = [
        [
            'current' => CardRequestsStatuses::Created,
            'next' => CardRequestsStatuses::Pending,
            'transition' => CreatedToPendingTransition::class,
        ],
        [
            'current' => CardRequestsStatuses::Created,
            'next' => CardRequestsStatuses::Canceled,
            'transition' => CreatedToCancelledTransition::class,
        ],
        [
            'current' => CardRequestsStatuses::Pending,
            'next' => CardRequestsStatuses::Accepted,
            'transition' => PendingToAcceptedTransition::class,
        ],
        [
            'current' => CardRequestsStatuses::Pending,
            'next' => CardRequestsStatuses::Canceled,
            'transition' => PendingToCancelledTransition::class,
        ],
        [
            'current' => CardRequestsStatuses::Accepted,
            'next' => CardRequestsStatuses::InProgress,
            'transition' => AcceptedToInProgressTransition::class,
        ],
        [
            'current' => CardRequestsStatuses::Accepted,
            'next' => CardRequestsStatuses::Canceled,
            'transition' => AcceptedToCancelledTransition::class,
        ],
        [
            'current' => CardRequestsStatuses::InProgress,
            'next' => CardRequestsStatuses::Completed,
            'transition' => InProgressToCompletedTransition::class,
        ],
        [
            'current' => CardRequestsStatuses::InProgress,
            'next' => CardRequestsStatuses::Canceled,
            'transition' => InProgressToCancelledTransition::class,
        ],
    ];

    public static function getTransition(State $current, CardRequestsStatuses $next): Transition
    {
        $item = collect(AllowedTransitions::ALL)
            ->first(fn (array $t) =>
                $t['current']->value === $current->value() &&
                $t['next'] === $next
            );

        if (!$item) {
            throw new InvalidArgumentException("No transition for {$current->value()} -> $next->value");
        }

        return new $item['transition'];
    }
}
