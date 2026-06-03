<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Profile> */
class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'bio' => fake()->paragraph(),
            'headline' => fake()->sentence(4),
            'occupation' => fake()->jobTitle(),
            'education' => fake()->randomElement(['Makerere University', 'Kyambogo University', 'Self taught', 'Business school']),
            'location' => fake()->city(),
            'max_distance' => 80,
            'age_min' => 20,
            'age_max' => 45,
            'show_me' => 'everyone',
            'profile_visibility' => 'public',
        ];
    }
}
