<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class Chat extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'chats';

    protected $fillable = [
        'member_id',
        'creator_id',
        'member_name',
        'creator_name',
    ];

    use HasFactory;

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'chat_id', 'id');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
