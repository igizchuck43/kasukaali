<?php

namespace Database\Factories;

use App\Models\Interest;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Interest> */
class InterestFactory extends Factory
{
    public function definition(): array
    {
        return ['name' => fake()->unique()->word(), 'slug' => fake()->unique()->slug(2), 'icon' => 'heart', 'status' => 'active'];
    }
}
