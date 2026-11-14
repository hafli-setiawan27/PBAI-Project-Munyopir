<?php

namespace Database\Factories;

use App\Enums\TripStatus;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trip>
 */
class TripFactory extends Factory
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
            'destination' => fake()->city(),
            'pickup_location' => fake()->address(),
            'pickup_at' => now()->addDay(),
            'status' => TripStatus::Scheduled,
        ];
    }
}
