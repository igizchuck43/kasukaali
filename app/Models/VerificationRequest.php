<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationRequest extends Model
{
    /** @use HasFactory<\Database\Factories\VerificationRequestFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'selfie_path', 'document_path', 'status', 'reviewed_by', 'reviewed_at', 'rejection_reason'];

    protected $casts = ['reviewed_at' => 'datetime'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
