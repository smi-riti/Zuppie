<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'discount_type',
        'discount_value',
        'description',
        'is_active',
        'is_special',
        'duration',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_special' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the images for this event package.
     */
    public function images()
    {
        return $this->hasMany(EventPackageImage::class);
    }

    public function getDiscountedPriceAttribute()
    {
        if (!$this->discount_type) {
            return $this->price;
        }

        if ($this->discount_type === 'percentage') {
            return $this->price * (1 - $this->discount_value / 100);
        }

        return $this->price - $this->discount_value;
    }
    
    /**
     * Format duration to readable time
     *
     * @return string
     */
    public function getFormattedDurationAttribute()
    {
        if (!$this->duration || !is_numeric($this->duration)) {
            return 'N/A';
        }
        
        // Convert milliseconds to minutes
        $totalMinutes = floor($this->duration / (1000 * 60));
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        
        if ($hours > 0 && $minutes > 0) {
            return $hours . 'h ' . $minutes . 'm';
        } elseif ($hours > 0) {
            return $hours . ' hour' . ($hours > 1 ? 's' : '');
        } elseif ($minutes > 0) {
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '');
        } else {
            return 'N/A';
        }
    }
    
    /**
     * Get duration in hours
     *
     * @return int
     */
    public function getDurationHoursAttribute()
    {
        if (!$this->duration) return 0;
        $totalMinutes = floor($this->duration / (1000 * 60));
        return floor($totalMinutes / 60);
    }
    
    /**
     * Get duration in remaining minutes (after hours)
     *
     * @return int
     */
    public function getDurationMinutesAttribute()
    {
        if (!$this->duration) return 0;
        $totalMinutes = floor($this->duration / (1000 * 60));
        return $totalMinutes % 60;
    }
}
