<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'indexPage']);
Route::get('/contact', [PageController::class, 'contactPage']);
