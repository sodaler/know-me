<?php

namespace App\Models;

use App\Enums\MediaTypesEnums;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string file_name
 * @property string mime_type
 * @property string path
 * @property string disk
 * @property string media_type
 * @property int size
 *
 * @method static Builder avatars();
 */
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

    /**
     * @return MorphTo
     */
    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeAvatars(Builder $query): void
    {
        $query->where('media_type', MediaTypesEnums::AVATAR->value);
    }
}
