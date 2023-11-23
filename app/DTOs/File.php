<?php

namespace App\DTOs;

class File
{
    public function __construct(
        public readonly string $fileName,
        public readonly string $mimeType,
        public readonly string $path,
        public readonly string $mediaType,
        public readonly int $size,
    ) {
    }

    public function toArray(): array
    {
        return [
            'file_name' => $this->fileName,
            'mime_type' => $this->mimeType,
            'path'=> $this->path,
            'media_type'=> $this->mediaType,
            'size'=> $this->size,
        ];
    }
}