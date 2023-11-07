<?php

namespace App\Models;

use App\Enums\Card\CardRequestsStatuses;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'student_id',
        'card_id',
        'status',
    ];

    protected $attributes = [
        'status' => 'created'
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function status(): Attribute
    {
        return new Attribute(
            get: fn(string $value) => CardRequestsStatuses::from($value)->createState($this)
        );
    }

    public function canBeChanged(): bool
    {
        return $this->status->canBeChanged();
    }
}
