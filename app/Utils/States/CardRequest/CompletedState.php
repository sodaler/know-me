<?php

namespace App\Utils\States\CardRequest;

class CompletedState extends State
{
    public function canBeChanged(): bool
    {
        return false;
    }

    public function value(): string
    {
        return 'completed';
    }

    public function humanValue(): string
    {
        return 'Завершено';
    }
}
