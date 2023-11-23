<?php

namespace App\Services\Media;

use App\Contracts\Models\HasMediaRelationInterface;
use App\Contracts\UploadContract;
use App\Enums\MediaTypesEnums;
use App\Models\Media;
use App\Services\Media\Loaders\AvatarLoader;
use App\Services\Media\Loaders\MediaTypeLoaderInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    protected function getLoader(MediaTypesEnums $mediaType): MediaTypeLoaderInterface
    {
        $loaderName = match ($mediaType) {
            MediaTypesEnums::AVATAR => AvatarLoader::class,
        };

        return new $loaderName;
    }

    protected function load(HasMediaRelationInterface $model, MediaTypesEnums $mediaType): Media
    {
        return $this->getLoader($mediaType)->load($model);
    }

    public function save(HasMediaRelationInterface $model, MediaTypesEnums $mediaType, UploadContract $uploadAction): void
    {
        DB::transaction(function () use ($uploadAction, $model, $mediaType) {
            $new = $uploadAction->exec($model, $mediaType);

            $media = $model->media()->firstOrNew(['path' => $new->path]);
            $media->fill($new->toArray());
            $media->save();
        });
    }

    public function delete(Media $media): void
    {
        $diskName = $media->disk;
        $path = $media->path;

        if ($media->delete()) {
            Storage::disk($diskName)->delete($path);
        }
    }

    public function update(HasMediaRelationInterface $model, MediaTypesEnums $mediaType, UploadContract $uploadAction): void
    {
        DB::transaction(function () use ($uploadAction, $model, $mediaType) {
            $this->delete($this->load($model, $mediaType));
            $this->save($model, $mediaType, $uploadAction);
        });
    }
}
