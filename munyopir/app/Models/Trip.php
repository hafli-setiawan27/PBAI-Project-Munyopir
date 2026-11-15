<?php

namespace App\Models;

use App\Enums\TripStatus;
use Database\Factories\TripFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @use HasFactory<TripFactory>
 */
class Trip extends Model
{
    protected $fillable = [
        'destination',
        'pickup_location',
        'pickup_at',
        'status',
    ];

    use HasFactory;

    protected function casts(): array
    {
        return [
            'pickup_at' => 'datetime',
            'status' => TripStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
