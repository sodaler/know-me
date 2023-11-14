<?php

namespace App\Actions\Uploads;

use App\Contracts\Models\HasMediaRelationInterface;
use App\Contracts\UploadContract;
use App\DTOs\File;
use App\Enums\MediaTypesEnums;
use Illuminate\Support\Facades\Storage;

final class ImageUploadAction implements UploadContract
{
    public function exec(HasMediaRelationInterface $model, MediaTypesEnums $mediaType): File
    {
        $disk = Storage::disk('images');

        $uploadedFile = request()->files('image');
        $className = strtolower(class_basename($model));
        $path = $disk->putFileAs("{$className}/{$model->id}", $uploadedFile, $uploadedFile->getClientOriginalName());

        return new File(
            fileName: $uploadedFile->getClientOriginalName(),
            mimeType: $uploadedFile->getMimeType(),
            path: $path,
            mediaType: $mediaType->value,
            size: $uploadedFile->getSize(),
        );
    }
}
