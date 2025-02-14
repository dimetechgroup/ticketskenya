<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;
    protected $fillable = [
        'order_id', // Order for which payment was made.
        'amount',  //Amount paid for the order.
        'currency', // Currency used for payment. : KES, USD, EUR
        'payment_status', // 'pending', 'successful', 'failed', 'refunded'
        'payment_method', // 'mpesa', 'card', 'paypal', 'stripe'
        'payment_ref', // Payment reference number.
        'payment_time', // Time the payment was made.
        'gateway_response', // Response from the payment gateway.
    ];
}
