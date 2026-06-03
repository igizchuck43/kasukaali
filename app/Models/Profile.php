<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'bio', 'headline', 'height', 'education', 'occupation', 'company',
        'religion', 'smoking', 'drinking', 'children', 'zodiac', 'personality_type',
        'love_language', 'location', 'latitude', 'longitude', 'max_distance',
        'age_min', 'age_max', 'show_me', 'profile_visibility',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
