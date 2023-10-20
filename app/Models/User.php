<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use MongoDB\Laravel\Eloquent\HybridRelations;
use MongoDB\Laravel\Relations\HasMany as HasManyMongo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HybridRelations;

    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function messagesSent(): HasManyMongo
    {
        return $this->hasMany(Message::class, 'to_id', 'id');
    }

    public function messagesReceived(): HasManyMongo
    {
        return $this->hasMany(Message::class, 'from_id', 'id');
    }
}
