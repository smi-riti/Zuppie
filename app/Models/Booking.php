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
        'event_end_date',
        'guest_count',
        'location',
        'special_requests',
        'status',
        'total_price',
        'pin_code',
        'is_completed',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'event_end_date' => 'datetime',
        'total_price' => 'decimal:2',
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
}