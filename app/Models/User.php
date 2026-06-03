<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
        'role',
        'status',
        'gender',
        'dob',
        'city',
        'country',
        'looking_for',
        'relationship_intention',
        'is_verified',
        'is_premium',
        'last_active_at',
        'approved_at',
        'approved_by',
        'rejected_reason',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'dob' => 'date',
            'is_verified' => 'boolean',
            'is_premium' => 'boolean',
            'last_active_at' => 'datetime',
            'approved_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ProfilePhoto::class);
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interest::class)->withTimestamps();
    }

    public function likerLikes(): HasMany
    {
        return $this->hasMany(Like::class, 'liker_id');
    }

    public function likedLikes(): HasMany
    {
        return $this->hasMany(Like::class, 'liked_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    public function verificationRequests(): HasMany
    {
        return $this->hasMany(VerificationRequest::class);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'blocker_id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isModerator(): bool
    {
        return $this->role === 'moderator';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }

    public function isBanned(): bool
    {
        return $this->status === 'banned';
    }

    public function isVerified(): bool
    {
        return (bool) $this->is_verified;
    }

    public function isPremium(): bool
    {
        return (bool) $this->is_premium;
    }

    public function age(): ?int
    {
        return $this->dob?->age;
    }

    public function primaryPhoto(): ?ProfilePhoto
    {
        return $this->photos()->where('is_primary', true)->first() ?? $this->photos()->orderBy('sort_order')->first();
    }

    public function profileCompletionPercentage(): int
    {
        return app(\App\Services\ProfileCompletionService::class)->calculate($this);
    }
}
