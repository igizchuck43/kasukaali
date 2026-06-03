<?php

namespace App\Services;

use App\Models\ProfilePhoto;
use App\Models\Report;
use App\Models\User;
use App\Models\VerificationRequest;

class ModerationService
{
    public function approveUser(User $user, User $admin): void
    {
        $user->update(['status' => 'approved', 'approved_at' => now(), 'approved_by' => $admin->id, 'rejected_reason' => null]);
    }

    public function rejectUser(User $user, User $admin, string $reason): void
    {
        $user->update(['status' => 'rejected', 'approved_at' => null, 'approved_by' => $admin->id, 'rejected_reason' => $reason]);
    }

    public function setPhotoStatus(ProfilePhoto $photo, string $status): void
    {
        $photo->update(['status' => $status]);
    }

    public function reviewReport(Report $report, User $reviewer, string $status, ?string $notes = null): void
    {
        $report->update(['status' => $status, 'reviewed_by' => $reviewer->id, 'reviewed_at' => now(), 'admin_notes' => $notes]);
    }

    public function approveVerification(VerificationRequest $request, User $reviewer): void
    {
        $request->update(['status' => 'approved', 'reviewed_by' => $reviewer->id, 'reviewed_at' => now(), 'rejection_reason' => null]);
        $request->user->update(['is_verified' => true]);
    }

    public function rejectVerification(VerificationRequest $request, User $reviewer, string $reason): void
    {
        $request->update(['status' => 'rejected', 'reviewed_by' => $reviewer->id, 'reviewed_at' => now(), 'rejection_reason' => $reason]);
    }
}
