<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Review\ReviewController;
use App\Http\Controllers\EventPackage\EventPackageController;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Gallery\GalleryApiController;
use App\Http\Controllers\User\UserApiController;
use App\Http\Controllers\Payment\RazorpayWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

// Webhook routes (no authentication required)
Route::post('/webhooks/razorpay', [RazorpayWebhookController::class, 'handleWebhook']);

// Public routes
Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

// Public API routes (read-only)
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/event-packages', [EventPackageController::class, 'index']);
Route::get('/event-packages/{eventPackage}', [EventPackageController::class, 'show']);
Route::get('/offers', [OfferController::class, 'index']);
Route::get('/offers/{offer}', [OfferController::class, 'show']);
Route::get('/reviews', [ReviewController::class, 'index']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::post('/logout', [LogoutController::class, 'logout']);
    
    // User can create reviews and bookings
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::apiResource('bookings', BookingController::class);
    
    // Admin only routes
    Route::middleware('admin')->group(function () {
        Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
        Route::apiResource('event-packages', EventPackageController::class)->except(['index', 'show']);
        Route::apiResource('offers', OfferController::class)->except(['index', 'show']);
        Route::apiResource('reviews', ReviewController::class)->except(['index', 'store']);
        Route::apiResource('blogs', BlogController::class);
        Route::apiResource('gallery',GalleryApiController::class)->except(['show']);
        Route::apiResource('users', UserApiController::class)->except(['show']);
    });
});