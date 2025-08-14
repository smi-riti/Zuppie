<?php

namespace App\Livewire\Public\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Title('Blog Detail')]

class BlogDetailPage extends Component
{
    public $slug;
    public $blog;
    public $relatedBlogs;

    public function mount($slug)
    {
        $this->slug = $slug;
        
        $this->blog = Blog::with(['category', 'author', 'featuredImage', 'galleryImages'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Get related blogs from the same category
        $this->relatedBlogs = Blog::with(['category', 'author', 'featuredImage'])
            ->published()
            ->where('id', '!=', $this->blog->id)
            ->when($this->blog->category_id, function($query) {
                $query->where('category_id', $this->blog->category_id);
            })
            ->latest()
            ->limit(3)
            ->get();
    }


    public function render()
    {
        return view('livewire.public.blog.blog-detail-page');
    }
}
