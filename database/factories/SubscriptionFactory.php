<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_id' => Member::factory(),

            'plan' => fake()->randomElement(['monthly', 'yearly']),
            'price' => fake()->numberBetween(200, 1000),

            'start_date' => now(),
            'end_date' => now()->addMonth(),

            'status' => fake()->randomElement(['active', 'expired']),

            'gym_id' => \App\Models\Gym::factory(),
        ];
    }
}
