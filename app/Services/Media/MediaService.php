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
    public function __construct(
        private readonly UploadContract $uploadAction
    ) {}

    /**
     * @param MediaTypesEnums $mediaType
     * @return MediaTypeLoaderInterface
     */
    protected function getLoader(MediaTypesEnums $mediaType): MediaTypeLoaderInterface
    {
        $loaderName = match ($mediaType) {
            MediaTypesEnums::AVATAR => AvatarLoader::class,
        };

        return new $loaderName;
    }

    public function save(HasMediaRelationInterface $model, MediaTypesEnums $mediaType): void
    {
        DB::transaction(function () use ($model, $mediaType) {
            $new = $this->uploadAction->exec($model, $mediaType);

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

    public function update(HasMediaRelationInterface $model, MediaTypesEnums $mediaType): void
    {
        DB::transaction(function () use ($model, $mediaType) {
            /** @var Media $avatar */
            $avatar = $this->getLoader($mediaType);

            $this->delete($avatar);
            $this->save($model, $mediaType);
        });
    }
}
