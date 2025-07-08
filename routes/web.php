<?php

use App\Livewire\Admin\Category\Show;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Public\Section\Homepage;
use App\Livewire\Admin\Category\ManageCategories;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', Homepage::class)->name('home');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');

Route::get('/admin/dashboard', function () {
    return view('livewire.admin.dashboard'); // Create this view
})->middleware('auth')->name('admin.dashboard');
Route::get('/admin/category/show', Show::class)->name('admin.category.show');