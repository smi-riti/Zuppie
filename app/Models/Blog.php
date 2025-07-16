<?php

namespace App\Models;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'image_file_id',
        'status',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Blog Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
{
    parent::boot();

    // Auto-generate unique slug from title
    static::creating(function ($blog) {
        $blog->slug = static::makeUniqueSlug($blog->title);
    });

    static::updating(function ($blog) {
        // Only regenerate slug if title was modified
        if ($blog->isDirty('title')) {
            $blog->slug = static::makeUniqueSlug($blog->title, $blog->id);
        }
    });
}

// Helper function to generate unique slugs
protected static function makeUniqueSlug($title, $excludeId = null)
{
    $slug = Str::slug($title);
    $originalSlug = $slug;
    $count = 2;

    $query = static::where('slug', $slug);
    
    // Exclude current model during updates
    if ($excludeId) {
        $query->where('id', '!=', $excludeId);
    }

    // Find next available unique slug
    while ($query->clone()->exists()) {
        $slug = $originalSlug . '-' . $count;
        $count++;
    }

    return $slug;
}

}
