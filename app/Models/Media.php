<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_name',
        'mime_type',
        'path',
        'disk',
        'file_hash',
        'media_type_id',
        'size',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function mediaType(): BelongsTo
    {
        return $this->belongsTo(MediaType::class);
    }

    public function scopeAvatar(Builder $query): void
    {
        //TODO? this fucking neccesary for AVATAR. Need to proccess this moment
        $query->whereHas('mediaType', function ($query) {
            $query->where('name', 'avatar');
        })->first();
    }
}
