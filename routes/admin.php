<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RsvpController;
use Illuminate\Support\Facades\Route;

// Apply admin middleware to all admin routes
Route::middleware(['auth', 'is_admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Groups
    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/groups/store', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit');
    Route::put('/groups/{group}/update', [GroupController::class, 'update'])->name('groups.update');
    Route::delete('/groups/{group}/delete', [GroupController::class, 'delete'])->name('groups.delete');

    // Guests
    Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::get('/guests/create', [GuestController::class, 'create'])->name('guests.create');
    Route::post('/guests/store', [GuestController::class, 'store'])->name('guests.store');
    Route::get('/guests/{guest}', [GuestController::class, 'show'])->name('guests.show');
    Route::get('/guests/{guest}/edit', [GuestController::class, 'edit'])->name('guests.edit');
    Route::put('/guests/{guest}/update', [GuestController::class, 'update'])->name('guests.update');
    Route::delete('/guests/{guest}/delete', [GuestController::class, 'delete'])->name('guests.delete');

    // RSVPs
    Route::get('/rsvps', [RsvpController::class, 'index'])->name('rsvps.index');
    Route::get('/rsvps/{rsvp}', [RsvpController::class, 'show'])->name('rsvps.show');
    Route::get('/rsvps/export', [RsvpController::class, 'export'])->name('rsvps.export');
});
