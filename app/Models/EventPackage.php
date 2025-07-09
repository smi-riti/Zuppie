<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class EventPackage extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'discount_type',
        'discount_value',
        'description',
        'images',
        'is_active',
        'is_special',
        'duration',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'is_special' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
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
}
