<?php

namespace App\Contracts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface UploadContract
{
    public function exec(UploadedFile $file, Model $model);
}