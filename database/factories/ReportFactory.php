<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Report> */
class ReportFactory extends Factory
{
    public function definition(): array
    {
        return ['reporter_id' => User::factory(), 'reported_user_id' => User::factory(), 'reason' => 'Spam', 'description' => fake()->sentence(), 'status' => 'pending'];
    }
}
