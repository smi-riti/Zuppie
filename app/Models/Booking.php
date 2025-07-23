<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'event_package_id',
        'booking_name',
        'booking_email',
        'booking_phone_no',
        'event_date',
        'event_time',
        'event_end_date',
        'guest_count',
        'location',
        'special_requests',
        'status',
        'total_price',
        'payment_method',
        'advance_amount',
        'advance_paid',
        'pin_code',
        'is_completed',
        'due_amount',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'event_time' => 'datetime:H:i',
        'event_end_date' => 'datetime',
        'total_price' => 'decimal:2',
        'advance_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',
        'advance_paid' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function eventPackage(): BelongsTo
    {
        return $this->belongsTo(EventPackage::class, 'event_package_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'booking_service', 'booking_id', 'service_id');
    }
}