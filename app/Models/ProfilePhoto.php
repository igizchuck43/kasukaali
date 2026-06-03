<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProfilePhoto extends Model
{
    /** @use HasFactory<\Database\Factories\ProfilePhotoFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'image_path', 'is_primary', 'is_verified_photo', 'sort_order', 'status'];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_verified_photo' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function url(): string
    {
        return $this->image_path ? Storage::url($this->image_path) : 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=900&q=80';
    }
}
