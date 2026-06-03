<?php

namespace App\Services;

use App\Models\Block;
use App\Models\Like;
use App\Models\User;
use App\Models\UserMatch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MatchingService
{
    public function likeUser(User $liker, User $liked, string $type = 'like'): array
    {
        return DB::transaction(function () use ($liker, $liked, $type) {
            $like = Like::updateOrCreate(
                ['liker_id' => $liker->id, 'liked_id' => $liked->id],
                ['type' => $type]
            );

            $match = $this->checkMutualLike($liker, $liked)
                ? $this->createMatch($liker, $liked)
                : null;

            return ['like' => $like, 'match' => $match];
        });
    }

    public function passUser(User $liker, User $liked): Like
    {
        return Like::updateOrCreate(
            ['liker_id' => $liker->id, 'liked_id' => $liked->id],
            ['type' => 'pass']
        );
    }

    public function checkMutualLike(User $liker, User $liked): bool
    {
        return Like::where('liker_id', $liked->id)
            ->where('liked_id', $liker->id)
            ->whereIn('type', ['like', 'super_like'])
            ->exists();
    }

    public function createMatch(User $userOne, User $userTwo): UserMatch
    {
        [$first, $second] = collect([$userOne->id, $userTwo->id])->sort()->values()->all();

        return UserMatch::firstOrCreate(
            ['user_one_id' => $first, 'user_two_id' => $second],
            ['matched_at' => now(), 'status' => 'active']
        );
    }

    public function getSuggestedProfiles(User $user): Collection
    {
        $hiddenIds = Like::where('liker_id', $user->id)->pluck('liked_id')
            ->merge(Block::where('blocker_id', $user->id)->pluck('blocked_id'))
            ->merge(Block::where('blocked_id', $user->id)->pluck('blocker_id'))
            ->merge(UserMatch::where('user_one_id', $user->id)->pluck('user_two_id'))
            ->merge(UserMatch::where('user_two_id', $user->id)->pluck('user_one_id'))
            ->unique()
            ->values();

        $profile = $user->profile;

        return User::query()
            ->with(['profile', 'photos', 'interests'])
            ->where('id', '!=', $user->id)
            ->where('status', 'approved')
            ->whereNotIn('status', ['suspended', 'banned'])
            ->whereNotIn('id', $hiddenIds)
            ->when($profile?->show_me && $profile->show_me !== 'everyone', fn ($query) => $query->where('gender', $profile->show_me))
            ->when($profile?->age_min, fn ($query) => $query->whereDate('dob', '<=', now()->subYears($profile->age_min)->toDateString()))
            ->when($profile?->age_max, fn ($query) => $query->whereDate('dob', '>=', now()->subYears($profile->age_max + 1)->toDateString()))
            ->latest('last_active_at')
            ->limit(20)
            ->get();
    }
}
