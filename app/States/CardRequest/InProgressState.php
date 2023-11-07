<?php

namespace App\States\CardRequest;

class InProgressState extends State
{
    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): string
    {
        return 'in_progress';
    }

    public function humanValue(): string
    {
        return 'В процессе';
    }
}
