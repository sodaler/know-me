<?php

namespace App\Services;

use App\Contracts\UploadContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class FileService
{
    public function __construct(
        private readonly UploadContract $uploadAction
    ) {
    }

    //TODO for other types.. (Bind via request('file') seems bad idea. I guess MATCH be better).
    public function save(UploadedFile $file, Model $model)
    {
        $model->media()->create($this->uploadAction->exec($file, $model));
    }
}
