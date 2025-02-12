<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;
    protected $fillable = [
        'event_id',
        'name',
        'price', // Price of the ticket.: if price is 0, then it's free.
        'discount',
        'currency',
        'quantity', // Total number of tickets available.
        'sold_quantity', // Number of tickets available.
        'description',
        'status', // 'draft', 'active', 'sold out', 'cancelled'
        'max_per_user', // Maximum tickets a user can buy.
        'min_per_user', // Minimum tickets a user can buy.
        'promo_code', // Optional promo code.
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
