<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'indexPage'])->name('landing.page');
Route::get('/contact-us', [PageController::class, 'contactPage']);
Route::get('/all-events/{event}', [PageController::class, 'singleEvent'])->name('event.single');
Route::get('/event/{event}/ticket/{ticket}', [PageController::class, 'eventTicketBuy'])->name('event.ticket.buy');
Route::post('/event/ticket/{ticket}/purchase', [PageController::class, 'purchaseTicket'])->name('event.ticket.purchase');
Route::get('sucessful-payment', [PageController::class, 'successfulPayment'])->name('successful.payment');
// download attendee ticket
Route::get('/ticket/{ticket}/download', [PageController::class, 'downloadTicket'])->name('attendees.download-ticket');
Route::get('about-us', [PageController::class, 'aboutUs'])->name('landing.aboutUs');
Route::get('contact-us', [PageController::class, 'contactUs'])->name('landing.contactUs');
Route::post('contact-us', [PageController::class, 'sendContactUsMessage'])->name('landing.contactUs.send');

// Route::get('terms-and-conditions', [PageController::class, 'termsAndConditions'])->name('landing.termsAndConditions');
// Route::get('privacy-policy', [PageController::class, 'privacyPolicy'])->name('landing.privacyPolicy');
