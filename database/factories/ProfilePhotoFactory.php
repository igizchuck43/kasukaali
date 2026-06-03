<?php

namespace Database\Factories;

use App\Models\ProfilePhoto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<ProfilePhoto> */
class ProfilePhotoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'image_path' => 'profile-photos/sample.jpg',
            'is_primary' => true,
            'sort_order' => 1,
            'status' => 'approved',
        ];
    }
}
