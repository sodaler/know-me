<?php

namespace App\Actions\Uploads;

use App\Contracts\UploadContract;
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
            'name' => $file->hashName(),
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'path' => $path,
            'file_hash' => hash_file(
                'md5',
                storage_path("app/public/$path"),
            ),
            'media_type_id' => 1, //TODO smooth. Enum ??
            'size' => $file->getSize(),
        ];
    }
}
