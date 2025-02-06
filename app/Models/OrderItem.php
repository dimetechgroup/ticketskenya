<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;
    protected $fillable = [
        'order_id', // Order for which the item was purchased.
        'ticket_id', // Ticket purchased.
        'quantity', // Number of tickets purchased.
        'amount', // Amount paid for the item.
        'currency', // Currency used for payment. : KES, USD, EUR
        'attendee_name', // Name of the attendee.
        'attendee_email', // Email of the attendee.
        'attendee_phone', // Phone number of the attendee.
        'status', // 'valid', 'used', 'cancelled',denied
        'qr_code', // QR code for the ticket.
        'checkin_time', // Time the ticket was checked in.
        'checkin_by', // User who checked in the ticket.
        'remarks', // Additional remarks. in case of denied
    ];
}
