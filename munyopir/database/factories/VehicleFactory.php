<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement(['Toyota Avanza', 'Honda HR-V', 'Mitsubishi Xpander']),
            'plate_number' => Str::upper(fake()->bothify('B #### ???')),
            'current_odometer' => fake()->numberBetween(1000, 100000),
        ];
    }
}
