<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\VerificationRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<VerificationRequest> */
class VerificationRequestFactory extends Factory
{
    public function definition(): array
    {
        return ['user_id' => User::factory(), 'selfie_path' => 'verification/selfie.jpg', 'document_path' => 'verification/document.jpg', 'status' => 'pending'];
    }
}
