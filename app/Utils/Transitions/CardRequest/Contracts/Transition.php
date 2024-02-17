<?php

namespace App\Utils\Transitions\CardRequest\Contracts;

use App\Models\CardRequest;
use Exception;

interface Transition
{
    /**
     * @throws Exception
     */
    public function execute(CardRequest $cardRequest): CardRequest;
}
