<?php

namespace App\Contracts;
use App\Contracts\Models\HasMediaRelationInterface;
use App\DTOs\File;
use App\Enums\MediaTypesEnums;

interface UploadContract
{
    public function exec(HasMediaRelationInterface $model, MediaTypesEnums $mediaType): File;
}
