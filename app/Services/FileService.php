<?php

namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function saveImage(string $path, UploadedFile $image): string
    {
        if ($image->getSize() > config('image.max_size')) {
            throw new Exception(__('errors.big_image'));
        }

        if (!in_array($image->getClientOriginalExtension(), config('image.allowed_exts'))) {
            throw new Exception(__('errors.ext_incorrect'));
        }

        return Storage::disk('public')
            ->putFileAs(
                $path,
                $image,
                $image->getClientOriginalName()
            );
    }
}