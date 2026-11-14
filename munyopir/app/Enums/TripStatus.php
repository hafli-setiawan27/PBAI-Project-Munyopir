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

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Scheduled => 'bg-sky-50 text-sky-800 ring-sky-700/10',
            self::Changed => 'bg-amber-50 text-amber-800 ring-amber-700/10',
            self::Completed => 'bg-emerald-50 text-emerald-800 ring-emerald-700/10',
            self::Cancelled => 'bg-slate-100 text-slate-600 ring-slate-500/10',
        };
    }
}
