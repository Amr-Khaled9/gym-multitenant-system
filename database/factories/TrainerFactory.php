<?php

namespace Database\Factories;

use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trainer>
 */
class TrainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'specialization' => fake()->randomElement(['Bodybuilding', 'Cardio']),
            'salary' => fake()->numberBetween(2000, 8000),

            'gym_id' => 1, // 🔥 مهم

        ];
    }
}
