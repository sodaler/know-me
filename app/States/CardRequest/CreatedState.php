<?php

namespace App\States\CardRequest;

class CreatedState extends State
{
    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): string
    {
        return 'created';
    }

    public function humanValue(): string
    {
        return 'Карточка создана';
    }
}
