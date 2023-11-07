<?php

namespace App\Actions\Uploads;

use App\Contracts\UploadContract;
use App\Enums\MediaTypesEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadAction implements UploadContract
{
    public function exec(UploadedFile $file, Model $model): array
    {
        $className = strtolower(class_basename($model));
        $path = Storage::disk('public')->putFileAs(
            "{$className}/{$model->id}",
            $file,
            $file->getClientOriginalName(),
        );

        return [
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'path' => $path,
            'media_type' => MediaTypesEnums::AVATAR->value,
            'size' => $file->getSize(),
        ];
    }
}