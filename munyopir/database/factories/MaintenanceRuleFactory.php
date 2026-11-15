<?php

namespace Database\Factories;

use App\Models\MaintenanceRule;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MaintenanceRule>
 */
class MaintenanceRuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::factory(),
            'name' => fake()->randomElement(['Ganti oli', 'STNK', 'KIR']),
            'interval_km' => 5000,
            'interval_days' => null,
            'last_service_odometer' => 50000,
            'last_service_date' => null,
            'expires_at' => null,
        ];
    }
}
