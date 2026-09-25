<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CounsellorController;

// Public routes
Route::get('/', [VisitorController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::get('/counsellor/{user}', [VisitorController::class, 'show'])->name('counsellor.show')->whereNumber('user');
Route::view('/contact', 'contact')->name('contact');

// Auth routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/counsellor-login', [AuthController::class, 'counsellorLoginForm'])->name('counsellor.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('otp.send');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/clear-otp', [AuthController::class, 'clearOtp'])->name('otp.clear');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/counsellors', [AdminController::class, 'counsellorsIndex'])->name('counsellors.index');
    Route::post('/counsellors', [AdminController::class, 'storeCounsellor'])->name('counsellors.store');
    Route::get('/counsellors/{user}/edit', [AdminController::class, 'editCounsellor'])->name('counsellors.edit');
    Route::put('/counsellors/{user}', [AdminController::class, 'updateCounsellor'])->name('counsellors.update');
    Route::delete('/counsellors/{user}', [AdminController::class, 'destroyCounsellor'])->name('counsellors.destroy');
    
    Route::get('/blogs', [AdminController::class, 'blogsIndex'])->name('blogs.index');
    Route::post('/blogs', [AdminController::class, 'storeBlog'])->name('blogs.store');
    Route::delete('/blogs/{blog}', [AdminController::class, 'destroyBlog'])->name('blogs.destroy');
    
    Route::get('/testimonials', [AdminController::class, 'testimonialsIndex'])->name('testimonials.index');
    Route::post('/testimonials', [AdminController::class, 'storeTestimonial'])->name('testimonials.store');
    Route::delete('/testimonials/{testimonial}', [AdminController::class, 'destroyTestimonial'])->name('testimonials.destroy');
});

// Counsellor routes
Route::middleware(['auth', 'role:counsellor'])->prefix('counsellor')->name('counsellor.')->group(function () {
    Route::get('/', [CounsellorController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [CounsellorController::class, 'bookings'])->name('bookings');
    Route::get('/availabilities', [CounsellorController::class, 'availabilities'])->name('availabilities');
    Route::get('/leaves', [CounsellorController::class, 'leaves'])->name('leaves');
    Route::post('/availabilities', [CounsellorController::class, 'storeAvailability'])->name('availabilities.store');
    Route::delete('/availabilities/{availability}', [CounsellorController::class, 'destroyAvailability'])->name('availabilities.destroy');
    Route::post('/leaves', [CounsellorController::class, 'storeLeave'])->name('leaves.store');
    Route::delete('/leaves/{leave}', [CounsellorController::class, 'destroyLeave'])->name('leaves.destroy');
    Route::post('/bookings/{booking}/accept', [CounsellorController::class, 'acceptBooking'])->name('bookings.accept');
    Route::post('/bookings/{booking}/cancel', [CounsellorController::class, 'cancelBooking'])->name('bookings.cancel');
    Route::post('/bookings/{booking}/complete', [CounsellorController::class, 'completeBooking'])->name('bookings.complete');
});

// User routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [VisitorController::class, 'dashboard'])->name('dashboard');
    Route::post('/book', [VisitorController::class, 'book'])->name('book');
    Route::post('/cancel/{booking}', [VisitorController::class, 'cancelBooking'])->name('cancel');
});
