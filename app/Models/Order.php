<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id', // User who placed the order.
        'event_id', // Event for which tickets were purchased.
        'total_amount',  //Total amount paid for the order.
        'currency', // Currency used for payment. : KES, USD, EUR
        'payment_status', // 'pending', 'successful', 'failed', 'refunded'
        'pay_unique_code', // Payment unique code.
    ];
}//