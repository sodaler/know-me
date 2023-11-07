<?php

namespace App\States\CardRequest;

class PendingState extends State
{
    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): string
    {
        return 'pending';
    }

    public function humanValue(): string
    {
        return 'В ожидании';
    }
}
