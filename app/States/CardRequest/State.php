<?php

namespace App\States\CardRequest;

use App\Models\CardRequest;
use InvalidArgumentException;

abstract class State
{
    public function __construct(
        protected CardRequest $cardRequest
    )
    {
    }

    abstract public function canBeChanged(): bool;

    abstract public function value(): string;

    abstract public function humanValue(): string;

    public function transitionTo(State $state): void
    {
        if (!$this->canBeChanged()) {
            throw new InvalidArgumentException(
                'Status can`t be changed'
            );
        }

        $this->cardRequest->updateQuietly([
            'status' => $state->value()
        ]);
    }

    public function getValue(): string
    {
        return $this->cardRequest->status->value();
    }
}
