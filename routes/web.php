<?php

use App\Livewire\Admin\Category\ManageCategories;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/category/manage-category', ManageCategories::class)->name('admin.manage-category');