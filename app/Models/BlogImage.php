<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'blog_id',
        'image_url',
        'image_file_id',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeGallery($query)
    {
        return $query->where('is_featured', false);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
