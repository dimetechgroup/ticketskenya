<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::any('paystack-callback', [PayStackController::class, 'paystackCallBack'])->name('paystack.callback');
