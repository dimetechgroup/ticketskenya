<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'indexPage']);
Route::get('/contact-us', [PageController::class, 'contactPage']);
Route::get('/all-events/{event}', [PageController::class, 'singleEvent'])->name('event.single');
Route::get('/event/{event}/ticket/{ticket}', [PageController::class, 'eventTicketBuy'])->name('event.ticket.buy');
Route::post('/event/{event}/ticket/{ticket}', [PageController::class, 'purchase'])->name('event.ticket.purchase');
