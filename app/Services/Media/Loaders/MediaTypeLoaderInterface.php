<?php

namespace App\Services\Media\Loaders;

use App\Contracts\Models\HasMediaRelationInterface;
use App\Models\Media;

interface MediaTypeLoaderInterface
{
    public function load(HasMediaRelationInterface $model): Media;
}
