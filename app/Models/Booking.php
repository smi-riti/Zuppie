<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\EventPackage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Payment;
class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'event_package_id',
        'booking_date',
        'event_date',
        'event_end_date',
        'guest_count',
        'location',
        'special_requests',
        'status', 
        'total_price',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'event_end_date' => 'datetime',
        'booking_date' => 'datetime',
        'total_price' => 'decimal:2',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function eventPackage()
    {
        return $this->belongsTo(EventPackage::class, 'event_package_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }


}

