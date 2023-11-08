<?php

namespace App\Actions\Uploads;

use App\Contracts\UploadContract;
use App\DTOs\File;
use App\Enums\MediaTypesEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadAction implements UploadContract
{
    public function exec(Model $model): File
    {
        $uploadedFile = request()->files('image');
        $className = strtolower(class_basename($model));
        $path = Storage::disk('public')->putFileAs(
            "{$className}/{$model->id}",
            $uploadedFile,
            $uploadedFile->getClientOriginalName(),
        );

        return new File(
            fileName: $uploadedFile->getClientOriginalName(),
            mimeType: $uploadedFile->getMimeType(),
            path: $path,
            mediaType: MediaTypesEnums::AVATAR->value,
            size: $uploadedFile->getSize(),
        );
    }
}