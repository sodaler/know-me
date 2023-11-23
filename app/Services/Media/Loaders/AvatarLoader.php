<?php

namespace App\Services\Media\Loaders;

use App\Contracts\Models\HasMediaRelationInterface;
use App\Models\Media;

class AvatarLoader implements MediaTypeLoaderInterface
{
    public function load(HasMediaRelationInterface $model): Media
    {
        return $model->media()->avatars()->first();
    }
}
