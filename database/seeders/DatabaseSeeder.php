<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Interest;
use App\Models\Page;
use App\Models\Profile;
use App\Models\ProfilePhoto;
use App\Models\SafetyTip;
use App\Models\SiteSetting;
use App\Models\SubscriptionPlan;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(['email' => 'admin@kasukaali.test'], [
            'name' => 'Kasukaali Admin', 'username' => 'kasukaali_admin', 'phone' => '+256700000001',
            'password' => Hash::make('password'), 'role' => 'admin', 'status' => 'approved',
            'gender' => 'woman', 'dob' => '1994-01-01', 'city' => 'Kampala', 'country' => 'Uganda',
            'looking_for' => 'everyone', 'relationship_intention' => 'Platform administration',
            'email_verified_at' => now(), 'approved_at' => now(),
        ]);

        User::updateOrCreate(['email' => 'moderator@kasukaali.test'], [
            'name' => 'Kasukaali Moderator', 'username' => 'kasukaali_moderator', 'phone' => '+256700000002',
            'password' => Hash::make('password'), 'role' => 'moderator', 'status' => 'approved',
            'gender' => 'man', 'dob' => '1992-02-02', 'city' => 'Kampala', 'country' => 'Uganda',
            'looking_for' => 'everyone', 'relationship_intention' => 'Moderation', 'email_verified_at' => now(),
            'approved_at' => now(), 'approved_by' => $admin->id,
        ]);

        $interests = collect(['Coffee', 'Music', 'Travel', 'Fitness', 'Movies', 'Cooking', 'Books', 'Dancing', 'Faith', 'Tech', 'Art', 'Football'])
            ->map(fn ($name) => Interest::updateOrCreate(['slug' => Str::slug($name)], ['name' => $name, 'icon' => 'heart', 'status' => 'active']));

        User::factory()->count(10)->approved()->create()->each(function (User $user) use ($interests, $admin) {
            $user->update(['approved_at' => now(), 'approved_by' => $admin->id]);
            Profile::factory()->create(['user_id' => $user->id]);
            ProfilePhoto::factory()->create(['user_id' => $user->id]);
            $user->interests()->sync($interests->random(4)->pluck('id'));
        });

        User::factory()->count(4)->pending()->create()->each(fn (User $user) => Profile::factory()->create(['user_id' => $user->id]));

        foreach ([['Free', 0, ['Create profile', 'Discover profiles', 'Limited likes', 'Chat with matches', 'Basic safety controls']], ['Plus', 25000, ['Unlimited likes', 'More filters', 'Rewind last pass', 'Hide ads']], ['Gold', 45000, ['See who liked you', 'Weekly super likes', 'Monthly boost', 'Priority discovery']], ['Platinum', 75000, ['Message before match', 'Top priority likes', 'Advanced visibility', 'Premium badge']]] as [$name, $price, $features]) {
            SubscriptionPlan::updateOrCreate(['slug' => Str::slug($name)], ['name' => $name, 'price' => $price, 'billing_period' => 'month', 'description' => $name === 'Free' ? 'Start meeting real people safely.' : 'Unlock richer discovery and visibility.', 'features' => $features, 'status' => 'active']);
        }

        foreach (['Is Kasukaali safe?' => 'Every registered account requires admin approval before dating features unlock.', 'Can I chat before matching?' => 'Standard users chat only after a mutual match.', 'How does verification work?' => 'Upload a selfie and document for admin review.', 'Are premium plans live?' => 'Plans are structured now; payment integration is a future step.'] as $question => $answer) {
            Faq::updateOrCreate(['question' => $question], ['answer' => $answer, 'category' => 'general', 'status' => 'active']);
        }

        foreach (['Meet in public first', 'Protect your private details', 'Use report and block', 'Trust your instincts', 'Verify profiles', 'Keep chats respectful'] as $index => $title) {
            SafetyTip::updateOrCreate(['title' => $title], ['content' => 'Use Kasukaali safety tools and take your time before sharing sensitive information.', 'icon' => 'shield', 'status' => 'active', 'sort_order' => $index]);
        }

        foreach (['Martha' => 'Kampala', 'Brian' => 'Entebbe', 'Sarah' => 'Jinja'] as $name => $location) {
            Testimonial::updateOrCreate(['name' => $name], ['location' => $location, 'story' => 'Kasukaali made meeting intentional people feel simple, warm, and safe.', 'status' => 'active']);
        }

        foreach (['terms-of-service' => 'Terms of Service', 'privacy-policy' => 'Privacy Policy', 'community-guidelines' => 'Community Guidelines'] as $slug => $title) {
            Page::updateOrCreate(['slug' => $slug], ['title' => $title, 'content' => "{$title} for Kasukaali. Respect, safety, privacy, and authenticity guide every interaction.", 'status' => 'published']);
        }

        foreach (['app_name' => 'Kasukaali', 'contact_email' => 'hello@kasukaali.test', 'footer_text' => 'Dating built for meaningful local connection.'] as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value, 'type' => 'text', 'group' => 'general']);
        }
    }
}
