<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Like> */
class LikeFactory extends Factory
{
    public function definition(): array
    {
        return ['liker_id' => User::factory(), 'liked_id' => User::factory(), 'type' => 'like'];
    }
}
