<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventPackageImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['event_package_id', 'image_url', 'image_file_id'];

    /**
     * Get the event package that owns the image.
     */
    public function eventPackage()
    {
        return $this->belongsTo(EventPackage::class);
    }
}
