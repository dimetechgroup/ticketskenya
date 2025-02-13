<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'indexPage']);
Route::get('/all-events/{event}', [PageController::class, 'singleEvent'])->name('event.single');
