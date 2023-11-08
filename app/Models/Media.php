<?php

namespace App\Models;

use App\Enums\MediaTypesEnums;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'mime_type',
        'path',
        'disk',
        'media_type',
        'size',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeAvatar(Builder $query): void
    {
        $query->where('media_type', MediaTypesEnums::AVATAR->value)->first();
    }
}