<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MongoDB\Laravel\Eloquent\Model;

class Message extends Model
{
    protected $collection = 'messages';

    protected $connection = 'mongodb';

    protected $fillable = [
        'to_id',
        'from_id',
        'content'
    ];

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_id', 'id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_id', 'id');
    }
}
