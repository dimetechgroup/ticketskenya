<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/landing.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::post('events/{event}/status', [EventController::class, 'updateStatus'])->name('events.status');
    Route::resource('events', EventController::class);  // event.tickets
    Route::resource('events.tickets', TicketController::class)->except(['index', 'show']);
    // route to view event attendees
    Route::get('events/{event}/attendees', [EventController::class, 'attendees'])->name('events.attendees');
    Route::post('/events/attendees/checkin/{id}', [EventController::class, 'checkInAttendee'])->name('event.attendees.checkin');
});

require __DIR__ . '/auth.php';
