<?php

namespace Database\Factories;

use App\Enums\ExpenseCategory;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Expense>
 */
class ExpenseFactory extends Factory
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
            'trip_id' => null,
            'category' => fake()->randomElement(ExpenseCategory::cases()),
            'amount' => fake()->numberBetween(10000, 500000),
            'expense_date' => fake()->date(),
            'description' => fake()->sentence(),
            'receipt_path' => null,
        ];
    }
}
