<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function saveImage(string $path, UploadedFile $image): string
    {
        return Storage::disk('public')
            ->putFileAs(
                $path,
                $image,
                $image->getClientOriginalName()
            );
    }
}
