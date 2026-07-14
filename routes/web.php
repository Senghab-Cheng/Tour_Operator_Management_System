<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ItineraryItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\TourScheduleController;
use App\Http\Controllers\TourScheduleCommentController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/services', 'service')->name('services');
Route::view('/destination', 'destination')->name('destination');
Route::view('/contact', 'contact')->name('contact');

require __DIR__.'/auth.php';

Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::prefix('tour-packages')->name('tour-packages.')->group(function () {
    Route::get('/', [TourPackageController::class, 'index'])->name('index');
    Route::get('/{tourPackage}/schedules', [TourScheduleController::class, 'byPackage'])->name('schedules');
    Route::get('/{tourPackage}/reviews', [ReviewController::class, 'index'])->name('reviews');
    Route::get('/{tourPackage}/itinerary', [ItineraryItemController::class, 'index'])->name('itinerary');
    Route::get('/{tourPackage}', [TourPackageController::class, 'show'])->name('show');
});

Route::get('/tour-schedules', [TourScheduleController::class, 'index'])->name('tour-schedules.index');
Route::get('/tour-schedules/{tourSchedule}', [TourScheduleController::class, 'show'])->name('tour-schedules.show');

Route::get('/tour-guides', [TourGuideController::class, 'index'])->name('tour-guides.index');
Route::get('/tour-guides/{tourGuide}', [TourGuideController::class, 'show'])->name('tour-guides.show');

Route::middleware('auth')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::middleware(['auth', 'staff'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/tour-packages', [TourPackageController::class, 'store'])->name('tour-packages.store');
    Route::put('/tour-packages/{tourPackage}', [TourPackageController::class, 'update'])->name('tour-packages.update');
    Route::delete('/tour-packages/{tourPackage}', [TourPackageController::class, 'destroy'])->name('tour-packages.destroy');

    Route::post('/tour-packages/{tourPackage}/itinerary', [ItineraryItemController::class, 'store'])->name('itinerary.store');
    Route::put('/tour-packages/{tourPackage}/itinerary/{itineraryItem}', [ItineraryItemController::class, 'update'])->name('itinerary.update');
    Route::delete('/tour-packages/{tourPackage}/itinerary/{itineraryItem}', [ItineraryItemController::class, 'destroy'])->name('itinerary.destroy');

    Route::get('/tour-schedules', [TourScheduleController::class, 'index'])->name('tour-schedules.index');
    Route::post('/tour-schedules', [TourScheduleController::class, 'store'])->name('tour-schedules.store');
    Route::put('/tour-schedules/{tourSchedule}', [TourScheduleController::class, 'update'])->name('tour-schedules.update');
    Route::delete('/tour-schedules/{tourSchedule}', [TourScheduleController::class, 'destroy'])->name('tour-schedules.destroy');

    Route::get('/trips/{tourSchedule}', [TourScheduleController::class, 'trip'])->name('trips.show');
    Route::post('/trips/{tourSchedule}/comments', [TourScheduleCommentController::class, 'store'])->name('trips.comments.store');

    Route::get('/tour-guides', [TourGuideController::class, 'index'])->name('tour-guides.index');
    Route::get('/tour-guides/{tourGuide}', [TourGuideController::class, 'show'])->name('tour-guides.show');
    Route::post('/tour-guides', [TourGuideController::class, 'store'])->name('tour-guides.store');
    Route::put('/tour-guides/{tourGuide}', [TourGuideController::class, 'update'])->name('tour-guides.update');
    Route::delete('/tour-guides/{tourGuide}', [TourGuideController::class, 'destroy'])->name('tour-guides.destroy');

    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.status');

    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/bookings/{booking}/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::patch('/payments/{payment}/status', [PaymentController::class, 'updateStatus'])->name('payments.status');
});