<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserMatch;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<UserMatch> */
class UserMatchFactory extends Factory
{
    public function definition(): array
    {
        return ['user_one_id' => User::factory(), 'user_two_id' => User::factory(), 'matched_at' => now(), 'status' => 'active'];
    }
}
