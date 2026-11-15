<?php

namespace App\Models;

use Database\Factories\MaintenanceRuleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class MaintenanceRule extends Model
{
    protected $fillable = [
        'name', 'interval_km', 'interval_days', 'last_service_odometer', 'last_service_date', 'expires_at',
    ];

    /** @use HasFactory<MaintenanceRuleFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'interval_km' => 'integer',
            'interval_days' => 'integer',
            'last_service_odometer' => 'integer',
            'last_service_date' => 'date',
            'expires_at' => 'date',
        ];
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function dueOdometer(): ?int
    {
        return $this->interval_km === null || $this->last_service_odometer === null
            ? null
            : $this->last_service_odometer + $this->interval_km;
    }

    public function dueDate(): ?Carbon
    {
        return $this->interval_days === null || $this->last_service_date === null
            ? null
            : $this->last_service_date->copy()->addDays($this->interval_days);
    }
}
