<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
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

            'gym_id' => 1,

            'trainer_id' => Trainer::inRandomOrder()->first()?->id,
        ];
    }
}
