<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'events';
    protected $primaryKey = 'id';


    protected $fillable = [
        'slug',
        'name',
        'description',
        'venue',
        'location', // 'online', 'offline'
        'start_date',
        'end_date',
        'status', //  'pending', 'approved', 'cancelled', 'completed'
        'image',
        'user_id',
        'meeting_link',
        'currency',
        'contact_number',
        'contact_email',
        'processing_fee',
        'is_private',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'is_private' => 'boolean',
        'status'     => 'string',
    ];


    // return event image url
    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/event-default.png');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function orders(): HasManyThrough
    {
        return $this->hasManyThrough(
            Order::class,
            Ticket::class,
            'event_id',
            'ticket_id',
            'id',
            'id'
        );
    }
}
