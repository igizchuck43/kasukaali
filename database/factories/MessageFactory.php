<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use App\Models\UserMatch;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Message> */
class MessageFactory extends Factory
{
    public function definition(): array
    {
        return ['match_id' => UserMatch::factory(), 'sender_id' => User::factory(), 'receiver_id' => User::factory(), 'message' => fake()->sentence(), 'is_read' => false];
    }
}
