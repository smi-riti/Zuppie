<?php

namespace App\Models;
use App\Models\User;
use App\Models\Category;
use App\Models\BlogImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%");
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->slug = static::makeUniqueSlug($blog->title);
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('title')) {
                $blog->slug = static::makeUniqueSlug($blog->title, $blog->id);
            }
        });
    }

    protected static function makeUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 2;

        $query = static::where('slug', $slug);
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(BlogImage::class)->orderBy('sort_order');
    }

    public function featuredImage()
    {
        return $this->hasOne(BlogImage::class)->where('is_featured', true);
    }

    public function galleryImages()
    {
        return $this->hasMany(BlogImage::class)->where('is_featured', false)->orderBy('sort_order');
    }

    // Simple accessor methods (not Laravel accessors)
    public function getFeaturedImageUrl()
    {
        $featuredImage = $this->featuredImage;
        return $featuredImage ? $featuredImage->image_url : null;
    }

    public function getGalleryImageUrls()
    {
        return $this->galleryImages->pluck('image_url')->toArray();
    }
}
