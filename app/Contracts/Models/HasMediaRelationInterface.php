<?php

namespace App\Contracts\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property int $id
 */
interface HasMediaRelationInterface
{
    public function media(): MorphMany;
}
