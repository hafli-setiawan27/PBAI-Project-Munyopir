<?php

namespace App\Enums;

enum ExpenseCategory: string
{
    case Fuel = 'bahan_bakar';
    case Toll = 'tol';
    case Parking = 'parkir';
    case Meals = 'makan';
    case Maintenance = 'perawatan';
    case Other = 'lainnya';

    public function label(): string
    {
        return match ($this) {
            self::Fuel => 'Bahan bakar',
            self::Toll => 'Tol',
            self::Parking => 'Parkir',
            self::Meals => 'Makan dan minum',
            self::Maintenance => 'Perawatan',
            self::Other => 'Lainnya',
        };
    }
}
