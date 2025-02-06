<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    /** @use HasFactory<\Database\Factories\WithdrawalFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id', // User who placed the withdrawal request.
        'event_id', // Event for which withdrawal is made.
        'amount',  //Amount to be withdrawn.
        'currency', // Currency to be withdrawn. : KES, USD, EUR
        'payment_method', // 'mpesa', 'card', 'paypal', 'stripe'
        'status', // 'pending', 'approved', 'denied'
        'message',
        'remarks', // Additional remarks. in case of denied
    ];
}
