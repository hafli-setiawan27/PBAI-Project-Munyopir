<?php

namespace App\Enums;

enum TripStatus: string
{
    case Scheduled = 'scheduled';
    case Changed = 'changed';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Scheduled => 'Terjadwal',
            self::Changed => 'Berubah',
            self::Completed => 'Selesai',
            self::Cancelled => 'Batal',
        };
    }

    /** @return array<int, self> */
    public function nextStatuses(): array
    {
        return match ($this) {
            self::Scheduled => [self::Changed],
            self::Changed => [self::Completed, self::Cancelled],
            self::Completed, self::Cancelled => [],
        };
    }

    public function canTransitionTo(self $status): bool
    {
        return in_array($status, $this->nextStatuses(), true);
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Scheduled => 'bg-brand-50 text-brand-800 ring-brand-700/10',
            self::Changed => 'bg-sky-50 text-brand-900 ring-sky-700/10',
            self::Completed => 'bg-accent-50 text-accent-700 ring-accent-600/10',
            self::Cancelled => 'bg-brand-100 text-brand-700 ring-brand-700/10',
        };
    }
}
