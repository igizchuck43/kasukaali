<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    /** @use HasFactory<\Database\Factories\LikeFactory> */
    use HasFactory;

    protected $fillable = ['liker_id', 'liked_id', 'type'];

    public function liker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'liker_id');
    }

    public function liked(): BelongsTo
    {
        return $this->belongsTo(User::class, 'liked_id');
    }
}
