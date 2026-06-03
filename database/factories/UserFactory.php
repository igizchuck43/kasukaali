<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('+2567########'),
            'role' => 'user',
            'status' => 'approved',
            'gender' => fake()->randomElement(['woman', 'man']),
            'dob' => fake()->dateTimeBetween('-45 years', '-19 years')->format('Y-m-d'),
            'city' => fake()->randomElement(['Kampala', 'Entebbe', 'Jinja', 'Mbarara']),
            'country' => 'Uganda',
            'looking_for' => fake()->randomElement(['women', 'men', 'everyone']),
            'relationship_intention' => fake()->randomElement(['Long-term relationship', 'New friends', 'Meaningful dating']),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn () => ['status' => 'pending']);
    }

    public function approved(): static
    {
        return $this->state(fn () => ['status' => 'approved']);
    }
}
