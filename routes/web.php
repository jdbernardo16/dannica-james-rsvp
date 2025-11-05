<?php

use App\Http\Controllers\RsvpController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Index');
})->name('home');

Route::get('/mobile', function () {
    return Inertia::render('IndexMobile');
})->name('home.mobile');

Route::get('/legacy', function () {
    return Inertia::render('Legacy');
})->name('legacy');

// Test route for layout testing
Route::get('/test-layout', function () {
    return Inertia::render('TestLayout');
})->name('test.layout');

// Public RSVP routes
Route::get('/rsvp', [RsvpController::class, 'create'])->name('rsvp.create');
Route::post('/rsvp/store', [RsvpController::class, 'store'])->name('rsvp.store');
Route::get('/rsvp/confirmation', [RsvpController::class, 'confirmation'])->name('rsvp.confirmation');
Route::post('/rsvp/check-guest', [RsvpController::class, 'checkGuest'])->name('rsvp.check-guest');
Route::post('/rsvp/resend-confirmation', [RsvpController::class, 'resendConfirmation'])->name('rsvp.resend-confirmation');
Route::get('/rsvp/preview-email', [RsvpController::class, 'previewEmail'])->name('rsvp.preview-email');

Route::prefix('admin')->group(function () {
    require __DIR__ . '/admin.php';
});
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
