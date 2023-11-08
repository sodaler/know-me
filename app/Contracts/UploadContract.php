<?php

namespace App\Contracts;
use App\DTOs\File;
use Illuminate\Database\Eloquent\Model;

interface UploadContract
{
    public function exec(Model $model): File;
}