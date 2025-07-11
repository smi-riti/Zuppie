<?php

use App\Livewire\Admin\Category\Show;
use App\Livewire\Admin\EventPackage\ListPackage;
use App\Livewire\Admin\Reviews\All;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Logout;
use App\Livewire\Public\Reviews\Add;
use App\Livewire\Public\Section\Homepage;
use App\Livewire\Public\Bookingform;
use App\Livewire\Admin\Booking\ManageBooking;
use App\Livewire\Admin\Category\ManageCategories;
use App\Livewire\Admin\User\ManageUser;
use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', Homepage::class)->name('home');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
Route::get('/booking',Bookingform::class)->name('booking');
Route::get('/reviews/add', Add::class)->name('reviews.add');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/category/show', Show::class)->name('admin.category.show');
    Route::get('/event-packages', ListPackage::class)->name('admin.event-packages');
    Route::get('/reviews/show', All::class)->name('admin.reviews.show');
    Route::get('/booking/manage', ManageBooking::class)->name('admin.booking.manage');
    Route::get('/users/manage', ManageUser::class)->name('admin.users.manage');

});
