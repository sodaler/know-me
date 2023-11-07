<?php

namespace App\States\CardRequest;

class AcceptedState extends State
{
    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): string
    {
        return 'accepted';
    }

    public function humanValue(): string
    {
        return 'Принято';
    }
}
