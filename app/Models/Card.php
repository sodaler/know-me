<?php

namespace App\Models;

use Elastic\ScoutDriverPlus\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Card extends Model
{
    use HasFactory, HasSlug, Searchable;

    protected $fillable = [
        'title',
        'description',
        'image',
        'rating',
        'alt',
        'slug',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function request(): HasOne
    {
        return $this->hasOne(CardRequest::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'created_at' => $this->created_at,
            'rating' => $this->rating,
            'skills' => $this->skills->pluck('slug'),
            'categories' => $this->categories->pluck('slug')
        ];
    }

    public function searchableWith(): array
    {
        return ['skills', 'categories'];
    }
}
