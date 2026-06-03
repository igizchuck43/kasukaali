<?php

namespace Tests\Feature;

use App\Models\Block;
use App\Models\Like;
use App\Models\Profile;
use App\Models\Report;
use App\Models\User;
use App\Models\UserMatch;
use App\Models\VerificationRequest;
use App\Services\MatchingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class KasukaaliFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_user_registration_redirects_to_pending_notice(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'New Member',
            'username' => 'new_member',
            'email' => 'new@kasukaali.test',
            'phone' => '+256700111222',
            'password' => 'password',
            'password_confirmation' => 'password',
            'gender' => 'woman',
            'dob' => now()->subYears(25)->toDateString(),
            'city' => 'Kampala',
            'looking_for' => 'men',
            'relationship_intention' => 'Long-term relationship',
            'terms' => '1',
        ]);

        $response->assertRedirect(route('notice.pending'));
        $this->assertDatabaseHas('users', ['email' => 'new@kasukaali.test', 'status' => 'pending', 'role' => 'user']);
    }

    public function test_pending_user_cannot_access_dashboard(): void
    {
        $user = User::factory()->pending()->create();

        $this->actingAs($user)->get(route('user.dashboard'))->assertRedirect(route('notice.pending'));
    }

    public function test_admin_can_approve_user_and_approved_user_can_access_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'approved']);
        $user = User::factory()->pending()->create();

        $this->actingAs($admin)->post(route('admin.users.approve', $user))->assertRedirect();

        $this->assertDatabaseHas('users', ['id' => $user->id, 'status' => 'approved', 'approved_by' => $admin->id]);
        $this->actingAs($user->fresh())->get(route('user.dashboard'))->assertOk();
    }

    public function test_user_can_update_profile(): void
    {
        $user = User::factory()->approved()->create();
        Profile::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->put(route('user.profile.update'), [
            'bio' => 'Warm, curious, and ready for something real.',
            'headline' => 'Good energy only',
            'age_min' => 22,
            'age_max' => 40,
            'show_me' => 'everyone',
            'profile_visibility' => 'public',
        ])->assertRedirect(route('user.profile'));

        $this->assertDatabaseHas('profiles', ['user_id' => $user->id, 'headline' => 'Good energy only']);
    }

    public function test_user_can_upload_photo(): void
    {
        Storage::fake('public');
        $user = User::factory()->approved()->create();
        $path = tempnam(sys_get_temp_dir(), 'kasukaali_png');
        file_put_contents($path, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII='));

        $this->actingAs($user)->post(route('user.photos.store'), [
            'photo' => new UploadedFile($path, 'profile.png', 'image/png', null, true),
        ])->assertRedirect();

        $this->assertDatabaseHas('profile_photos', ['user_id' => $user->id, 'status' => 'pending']);
    }

    public function test_user_can_like_another_user_and_mutual_like_creates_match(): void
    {
        $a = User::factory()->approved()->create();
        $b = User::factory()->approved()->create();
        Like::create(['liker_id' => $b->id, 'liked_id' => $a->id, 'type' => 'like']);

        $result = app(MatchingService::class)->likeUser($a, $b);

        $this->assertNotNull($result['match']);
        $this->assertDatabaseCount('matches', 1);
    }

    public function test_matched_users_can_chat_and_unmatched_users_cannot_chat(): void
    {
        $a = User::factory()->approved()->create();
        $b = User::factory()->approved()->create();
        $c = User::factory()->approved()->create();
        $match = UserMatch::create(['user_one_id' => $a->id, 'user_two_id' => $b->id, 'status' => 'active', 'matched_at' => now()]);

        $this->actingAs($a)->post(route('user.chat.store', $match), ['message' => 'Hello there'])->assertRedirect();
        $this->assertDatabaseHas('messages', ['sender_id' => $a->id, 'receiver_id' => $b->id, 'message' => 'Hello there']);
        $this->actingAs($c)->post(route('user.chat.store', $match), ['message' => 'Nope'])->assertForbidden();
    }

    public function test_user_can_report_another_user(): void
    {
        $a = User::factory()->approved()->create();
        $b = User::factory()->approved()->create();

        $this->actingAs($a)->post(route('user.reports.store'), [
            'reported_user_id' => $b->id,
            'reason' => 'Spam',
            'description' => 'Suspicious links.',
        ])->assertRedirect();

        $this->assertDatabaseHas('reports', ['reporter_id' => $a->id, 'reported_user_id' => $b->id]);
    }

    public function test_admin_can_approve_verification(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'approved']);
        $user = User::factory()->approved()->create();
        $verification = VerificationRequest::factory()->create(['user_id' => $user->id]);

        $this->actingAs($admin)->post(route('admin.verifications.approve', $verification))->assertRedirect();

        $this->assertTrue($user->fresh()->is_verified);
    }

    public function test_blocked_users_do_not_appear_in_discovery(): void
    {
        $a = User::factory()->approved()->create();
        $b = User::factory()->approved()->create();
        Profile::factory()->create(['user_id' => $a->id, 'age_min' => 18, 'age_max' => 60]);
        Profile::factory()->create(['user_id' => $b->id]);
        Block::create(['blocker_id' => $a->id, 'blocked_id' => $b->id]);

        $suggestions = app(MatchingService::class)->getSuggestedProfiles($a);

        $this->assertFalse($suggestions->contains('id', $b->id));
    }
}
