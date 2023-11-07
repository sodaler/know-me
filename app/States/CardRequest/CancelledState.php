<?php

namespace App\States\CardRequest;

class CancelledState extends State
{
    public function canBeChanged(): bool
    {
        return false;
    }

    public function value(): string
    {
        return 'cancelled';
    }

    public function humanValue(): string
    {
        return 'Отменено';
    }
}
