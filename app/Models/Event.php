<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'venue',
        'location', // 'online', 'offline'
        'start_date',
        'end_date',
        'status', // 'draft', 'pending', 'approved', 'cancelled', 'completed'
        'image',
        'user_id',
        'meeting_link',
        'currency',
        'contact_number',
        'contact_email',
        'processing_fee',
        'is_private',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
