<?php

use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\MatchController as AdminMatchController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProfilePhotoController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SafetyTipController as AdminSafetyTipController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VerificationController as AdminVerificationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NoticeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\DiscoverController;
use App\Http\Controllers\User\MatchController;
use App\Http\Controllers\User\PhotoController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SafetyController;
use App\Http\Controllers\User\SettingsController;
use App\Http\Controllers\User\SubscriptionController;
use App\Http\Controllers\User\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/how-it-works', [PageController::class, 'howItWorks'])->name('how');
Route::get('/features', [PageController::class, 'features'])->name('features');
Route::get('/safety', [PageController::class, 'safety'])->name('safety');
Route::get('/premium', [PageController::class, 'premium'])->name('premium');
Route::get('/success-stories', [PageController::class, 'stories'])->name('stories');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/join-now', [PageController::class, 'join'])->name('join');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/approval-pending', [NoticeController::class, 'pending'])->name('notice.pending');
    Route::get('/account-rejected', [NoticeController::class, 'rejected'])->name('notice.rejected');
    Route::get('/account-suspended', [NoticeController::class, 'suspended'])->name('notice.suspended');
});

Route::middleware(['auth', 'approved'])->prefix('app')->name('user.')->group(function () {
    Route::get('/dashboard', UserDashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/photos', [PhotoController::class, 'index'])->name('photos');
    Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::patch('/photos/{photo}/primary', [PhotoController::class, 'primary'])->name('photos.primary');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    Route::get('/discover', [DiscoverController::class, 'index'])->name('discover');
    Route::post('/discover/{user}/like', [DiscoverController::class, 'like'])->name('discover.like');
    Route::post('/discover/{user}/pass', [DiscoverController::class, 'pass'])->name('discover.pass');
    Route::get('/matches', [MatchController::class, 'index'])->name('matches');
    Route::patch('/matches/{match}/unmatch', [MatchController::class, 'unmatch'])->name('matches.unmatch');
    Route::get('/chat/{match}', [ChatController::class, 'show'])->name('chat');
    Route::post('/chat/{match}', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/likes-received', fn () => view('user.likes', ['title' => 'Likes Received']))->name('likes.received');
    Route::get('/who-i-liked', fn () => view('user.likes', ['title' => 'Who I Liked']))->name('likes.sent');
    Route::get('/verification', [VerificationController::class, 'index'])->name('verification');
    Route::post('/verification', [VerificationController::class, 'store'])->name('verification.store');
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription');
    Route::get('/boost-profile', [SubscriptionController::class, 'boost'])->name('boost');
    Route::get('/settings', SettingsController::class)->name('settings');
    Route::get('/safety-center', [SafetyController::class, 'index'])->name('safety');
    Route::get('/reports', [SafetyController::class, 'reports'])->name('reports');
    Route::post('/reports', [SafetyController::class, 'report'])->name('reports.store');
    Route::get('/blocked-users', [SafetyController::class, 'blocked'])->name('blocked');
    Route::post('/block/{user}', [SafetyController::class, 'block'])->name('block');
    Route::get('/notifications', fn () => view('user.empty', ['title' => 'Notifications']))->name('notifications');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::get('/pending-approvals', [ApprovalController::class, 'index'])->name('approvals');
    Route::post('/users/{user}/approve', [ApprovalController::class, 'approve'])->name('users.approve');
    Route::post('/users/{user}/reject', [ApprovalController::class, 'reject'])->name('users.reject');
    Route::post('/users/{user}/suspend', [ApprovalController::class, 'suspend'])->name('users.suspend');
    Route::post('/users/{user}/ban', [ApprovalController::class, 'ban'])->name('users.ban');
    Route::post('/users/{user}/restore', [ApprovalController::class, 'restore'])->name('users.restore');
    Route::post('/users/{user}/verify', [ApprovalController::class, 'verify'])->name('users.verify');
    Route::post('/users/{user}/unverify', [ApprovalController::class, 'unverify'])->name('users.unverify');
    Route::get('/profiles', fn () => view('admin.simple-table', ['title' => 'Profiles', 'items' => \App\Models\Profile::with('user')->latest()->paginate(15), 'columns' => ['id', 'headline', 'location']]))->name('profiles');
    Route::get('/profile-photos', [ProfilePhotoController::class, 'index'])->name('photos');
    Route::post('/profile-photos/{photo}/approve', [ProfilePhotoController::class, 'approve'])->name('photos.approve');
    Route::post('/profile-photos/{photo}/reject', [ProfilePhotoController::class, 'reject'])->name('photos.reject');
    Route::get('/matches', [AdminMatchController::class, 'index'])->name('matches');
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports');
    Route::patch('/reports/{report}', [AdminReportController::class, 'update'])->name('reports.update');
    Route::get('/verification-requests', [AdminVerificationController::class, 'index'])->name('verifications');
    Route::post('/verification-requests/{verificationRequest}/approve', [AdminVerificationController::class, 'approve'])->name('verifications.approve');
    Route::post('/verification-requests/{verificationRequest}/reject', [AdminVerificationController::class, 'reject'])->name('verifications.reject');
    Route::get('/subscriptions', fn () => view('admin.simple-table', ['title' => 'Subscriptions', 'items' => \App\Models\UserSubscription::latest()->paginate(15), 'columns' => ['id', 'status', 'payment_status']]))->name('subscriptions');
    Route::get('/plans', [PlanController::class, 'index'])->name('plans');
    Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
    Route::get('/boosts', fn () => view('admin.simple-table', ['title' => 'Boosts', 'items' => \App\Models\Boost::latest()->paginate(15), 'columns' => ['id', 'starts_at', 'status']]))->name('boosts');
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
    Route::get('/faqs', [AdminFaqController::class, 'index'])->name('faqs');
    Route::post('/faqs', [AdminFaqController::class, 'store'])->name('faqs.store');
    Route::get('/safety-tips', [AdminSafetyTipController::class, 'index'])->name('safety-tips');
    Route::post('/safety-tips', [AdminSafetyTipController::class, 'store'])->name('safety-tips.store');
    Route::get('/pages', [AdminPageController::class, 'index'])->name('pages');
    Route::post('/pages', [AdminPageController::class, 'store'])->name('pages.store');
    Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages');
    Route::post('/contact-messages/{contactMessage}/read', [ContactMessageController::class, 'read'])->name('contact-messages.read');
    Route::get('/site-settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/site-settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('/profile', fn () => view('admin.profile'))->name('profile');
});

Route::middleware(['auth', 'moderator'])->prefix('moderator')->name('moderator.')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports');
    Route::get('/profile-photos', [ProfilePhotoController::class, 'index'])->name('photos');
    Route::get('/verification-requests', [AdminVerificationController::class, 'index'])->name('verifications');
});
