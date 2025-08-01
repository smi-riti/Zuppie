<?php

use App\Http\Controllers\BookingInvoice;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\RobotsController;
use App\Livewire\Admin\Category\Show;
use App\Livewire\Admin\Enquiry\AllEnquiry;
use App\Livewire\Admin\EventPackage\ListPackage;
use App\Livewire\Admin\EventPackage\CreatePackage;
use App\Livewire\Admin\EventPackage\UpdatePackage;
use App\Livewire\Admin\Offers\AllOffers;
use App\Livewire\Admin\Offers\ShowAll;
use App\Livewire\Admin\Reviews\All;
use App\Livewire\Auth\ForgotPass;
use App\Livewire\Auth\ResetPass;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Logout;
use App\Livewire\Public\Section\About;
use App\Livewire\Public\Section\Contact;
use App\Livewire\Public\Section\Homepage;
use App\Livewire\Public\Bookingform;
use App\Livewire\Admin\Booking\ManageBooking;
use App\Livewire\Admin\Category\ManageCategories;
use App\Livewire\Admin\User\ManageUser;
use App\Livewire\Admin\Setting\ManageSetting;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Public\User\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Service\Show as ShowService;
use App\Livewire\Public\Event\EventPackage;
use App\Livewire\Public\Event\PackageDetail;
use App\Livewire\Public\Event\PackageBookingForm;
use App\Livewire\Public\Event\ManageBooking as PublicManageBooking;
use App\Livewire\Admin\Booking\ViewBooking;

use App\Livewire\Admin\Blog\ManageBlog;
use App\Livewire\Public\Blog\BlogPage;
use App\Livewire\Public\Blog\BlogDetailPage;
use App\Livewire\Admin\Gallery\ManageGallery;
use App\Livewire\Public\Pages\TermsOfService;
use App\Livewire\Public\Pages\PrivacyPolicy;
use App\Livewire\Public\Event\EventPackageFilter;
use Illuminate\Support\Facades\Auth;
use App\Mail\LoginNotificationMail;
// use App\Livewire\Auth\OtpLogin;
// use App\Livewire\Auth\OtpVerify;
use App\Livewire\Auth\PhoneOtpLogin;
use App\Livewire\Auth\PhoneOtpVerify;

Route::get('/', Homepage::class)->name('home');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');

// Phone OTP Routes
Route::get('/phone-otp-login', PhoneOtpLogin::class)->name('phone.otp.login');
Route::get('/phone-otp-verify/{phone_no}', PhoneOtpVerify::class)->name('phone.otp.verify');
// Route::get('/otp-login', OtpLogin::class)->name('otp.login');
// Route::get('/otp-verify/{email}', OtpVerify::class)->name('otp.verify');
Route::get('/forgot-password', ForgotPass::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPass::class)->name('password.reset');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/about', About::class)->name('about');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/booking', Bookingform::class)->name('booking');
Route::get('/terms-of-service', TermsOfService::class)->name('terms-of-service');
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy-policy');

// Event Package Routes
Route::get('/event-packages', EventPackage::class)->name('event-packages');
Route::get('/package-detail/{id}', PackageDetail::class)->name('package-detail');
Route::get('/package-booking-form', PackageBookingForm::class)->name('package-booking');
Route::get('/package-booking/{package_id?}', PackageBookingForm::class)->name('package-booking-form');
Route::get('/events/filter', EventPackageFilter::class)->name('event-package.filter');

// Blog Routes
Route::get('/blog', BlogPage::class)->name('blog');
Route::get('/blog/{slug}', BlogDetailPage::class)->name('blog.detail');

// User profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
});
// Route::get('/profile/manage-booking/{booking_id?}', PublicManageBooking::class)->name('manage-booking');


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/categories', Show::class)->name('admin.categories');
    Route::get('/category/show', Show::class)->name('admin.category.show');
    Route::get('/event-packages', ListPackage::class)->name('admin.event-packages');
    Route::get('/event-packages/create', CreatePackage::class)->name('admin.event-packages.create');
    Route::get('/event-packages/edit/{packageId}', UpdatePackage::class)->name('admin.event-packages.edit');
    Route::get('/reviews/show', All::class)->name('admin.reviews.show');
    Route::get('/offers/all', AllOffers::class)->name('admin.offers.show');
    Route::get('/enquiries/all', AllEnquiry::class)->name('admin.enquiries.all');
    Route::get('/booking/manage', ManageBooking::class)->name('admin.booking.manage');
    Route::get('/booking/view/{bookingId}', ViewBooking::class)->name('admin.booking.view');
    Route::get('/users/manage', ManageUser::class)->name('admin.users.manage');
    Route::get('/services/manage', ShowService::class)->name('admin.services.manage');
    Route::get('/manage/blogs', ManageBlog::class)->name('admin.blogs.manage');
    Route::get('/settings', ManageSetting::class)->name('admin.settings');
    Route::get('/admin/gallery', ManageGallery::class)->name('gallery.manage');

});

// SEO Routes - Production Optimized
Route::get('/sitemap.xml', [\App\Http\Controllers\ProductionSitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap/static.xml', [\App\Http\Controllers\ProductionSitemapController::class, 'static'])->name('sitemap.static');
Route::get('/sitemap/categories.xml', [\App\Http\Controllers\ProductionSitemapController::class, 'categories'])->name('sitemap.categories');
Route::get('/sitemap/packages.xml', [\App\Http\Controllers\ProductionSitemapController::class, 'packages'])->name('sitemap.packages');
Route::get('/sitemap/offers.xml', [\App\Http\Controllers\ProductionSitemapController::class, 'offers'])->name('sitemap.offers');
Route::get('/sitemap/blogs.xml', [\App\Http\Controllers\ProductionSitemapController::class, 'blogs'])->name('sitemap.blogs');
Route::get('/robots.txt', [\App\Http\Controllers\ProductionRobotsController::class, 'index'])->name('robots');
Route::get('/mail', [\App\Http\Controllers\MailController::class, 'sendEmail'])->name('mail');

// PWA Routes
Route::get('/manifest.json', function () {
    return response()->json([
        'name' => 'Zuppie - Event Management',
        'short_name' => 'Zuppie',
        'description' => 'Premium event planning and birthday celebration services',
        'start_url' => '/',
        'display' => 'standalone',
        'background_color' => '#ffffff',
        'theme_color' => '#8B5CF6',
        'icons' => [
            [
                'src' => '/images/icons/icon-192x192.png',
                'sizes' => '192x192',
                'type' => 'image/png'
            ],
            [
                'src' => '/images/icons/icon-512x512.png',
                'sizes' => '512x512',
                'type' => 'image/png'
            ]
        ]
    ]);
})->name('manifest');

Route::get('/browserconfig.xml', function () {
    return response()->view('browserconfig')->header('Content-Type', 'text/xml');
})->name('browserconfig');


Route::get('/invoices/{invoice}/download', [BookingInvoice::class, 'downloadInvoice'])
     ->name('invoices.download');