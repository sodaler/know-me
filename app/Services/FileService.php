<?php

namespace App\Services;

use App\Contracts\UploadContract;
use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function __construct(
        private readonly UploadContract $uploadAction
    ) {
    }

    //TODO for other types.. (Bind via request('file') seems bad idea. I guess MATCH be better).
    public function save(UploadedFile $file, Model $model): Media
    {
        $new = $this->uploadAction->exec($file, $model);

        $media = $model->media()->firstOrNew(['path' => $new['path']]);
        $media->fill($new);
        $media->save();
    
        return $media;
    }

    public function delete(?Media $media): void
    {
        $media ? Storage::disk('public')->delete($media->path) : null;
        $media?->delete();
    }
}
