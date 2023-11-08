<?php

namespace App\Services\Media;

use App\Contracts\UploadContract;
use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    public function __construct(
        private readonly UploadContract $uploadAction
    ) {
    }

    public function saveFor($model)
    {
        DB::transaction(function () use ($model) {
            $new = $this->uploadAction->exec($model);

            $media = $model->media()->firstOrNew(['path' => $new->path]);
            $media->fill($new->toArray());
            $media->save();
        });
    }

    public function delete(Media $media)
    {
        DB::transaction(function () use ($media) {
            Storage::disk('public')->delete($media->path);
            $media->delete();
        });
    }

    public function refreshAvatarFor(Model $model)
    {
        DB::transaction(function () use ($model) {
            $this->delete($model->media()->avatar()->first());
            $this->saveFor($model);
        });
    }
}