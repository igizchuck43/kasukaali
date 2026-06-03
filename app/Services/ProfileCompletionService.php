<?php

namespace App\Services;

use App\Models\User;

class ProfileCompletionService
{
    public function calculate(User $user): int
    {
        $user->loadMissing(['profile', 'photos', 'interests', 'verificationRequests']);

        $checks = [
            $user->photos->isNotEmpty(),
            filled($user->profile?->bio),
            filled($user->city) || filled($user->profile?->location),
            $user->interests->isNotEmpty(),
            filled($user->looking_for),
            filled($user->profile?->occupation),
            filled($user->relationship_intention),
            $user->is_verified || $user->verificationRequests->isNotEmpty(),
        ];

        return (int) round((collect($checks)->filter()->count() / count($checks)) * 100);
    }
}
