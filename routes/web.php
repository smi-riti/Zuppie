<?php

use App\Livewire\Admin\Category\Show;
use App\Livewire\Admin\Enquiry\AllEnquiry;
use App\Livewire\Admin\EventPackage\ListPackage;
use App\Livewire\Admin\Offers\AllOffers;
use App\Livewire\Admin\Offers\ShowAll;
use App\Livewire\Admin\Reviews\All;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Logout;
use App\Livewire\Public\Reviews\Add;
use App\Livewire\Public\Section\About;
use App\Livewire\Public\Section\Contact;
use App\Livewire\Public\Section\Homepage;
use App\Livewire\Public\Bookingform;
use App\Livewire\Admin\Booking\ManageBooking;
use App\Livewire\Admin\Category\ManageCategories;
use App\Livewire\Admin\User\ManageUser;
use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Service\Show as ShowService;
use App\Livewire\Public\Event\EventPackage;
use App\Livewire\Public\Event\PackageDetail;
use App\Livewire\Public\Event\PackageBookingForm;
use App\Livewire\Public\Event\ManageBooking as PublicManageBooking;
use App\Livewire\Admin\Blog\ManageBlog;
use App\Livewire\Admin\Gallery\ManageGallery;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', Homepage::class)->name('home');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
Route::get('/about', About::class)->name('about');
Route::get('/contact',Contact::class)->name('contact');
Route::get('/booking',Bookingform::class)->name('booking');
Route::get('/reviews/add', Add::class)->name('reviews.add');

// Event Package Routes
Route::get('/event-packages', EventPackage::class)->name('event-packages');
Route::get('/package-detail/{id}', PackageDetail::class)->name('package-detail');
Route::get('/package-booking-form', PackageBookingForm::class)->name('package-booking');
Route::get('/package-booking/{package_id?}', PackageBookingForm::class)->name('package-booking-form');
Route::get('/manage-booking/{booking_id?}', PublicManageBooking::class)->name('manage-booking');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/category/show', Show::class)->name('admin.category.show');
    Route::get('/event-packages', ListPackage::class)->name('admin.event-packages');
    Route::get('/reviews/show', All::class)->name('admin.reviews.show');
    Route::get('/offers/all', AllOffers::class)->name('admin.offers.show');
    Route::get('/enquiries/all', AllEnquiry::class)->name('admin.enquiries.all');
    Route::get('/booking/manage', ManageBooking::class)->name('admin.booking.manage');
    Route::get('/users/manage', ManageUser::class)->name('admin.users.manage');
    Route::get('/services/manage', ShowService::class)->name('admin.services.manage');
    Route::get('/manage/blogs', ManageBlog::class)->name('admin.blogs.manage');
    Route::get('/admin/gallery', ManageGallery::class)->name('gallery.manage');

});
