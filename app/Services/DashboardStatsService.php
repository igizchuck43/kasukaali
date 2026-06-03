<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Report;
use App\Models\User;
use App\Models\UserMatch;

class DashboardStatsService
{
    public function userStats(User $user): array
    {
        return [
            'Profile Completion' => $user->profileCompletionPercentage().'%',
            'Total Matches' => UserMatch::where('user_one_id', $user->id)->orWhere('user_two_id', $user->id)->count(),
            'Unread Messages' => Message::where('receiver_id', $user->id)->where('is_read', false)->count(),
            'Likes Received' => $user->likedLikes()->whereIn('type', ['like', 'super_like'])->count(),
            'Profile Views' => '128',
            'Verification Status' => $user->isVerified() ? 'Verified' : 'Pending',
            'Subscription Status' => $user->isPremium() ? 'Premium' : 'Free',
        ];
    }

    public function adminStats(): array
    {
        return [
            'Total Users' => User::count(),
            'Pending Approvals' => User::where('status', 'pending')->count(),
            'Approved Users' => User::where('status', 'approved')->count(),
            'Rejected Users' => User::where('status', 'rejected')->count(),
            'Suspended Users' => User::where('status', 'suspended')->count(),
            'Banned Users' => User::where('status', 'banned')->count(),
            'Verified Profiles' => User::where('is_verified', true)->count(),
            'Total Matches' => UserMatch::count(),
            'Total Messages' => Message::count(),
            'Reports Pending' => Report::where('status', 'pending')->count(),
            'Premium Users' => User::where('is_premium', true)->count(),
            'Revenue Placeholder' => 'UGX 0',
        ];
    }
}
