<?php

namespace App\Livewire\Public\Blog;

use App\Models\Blog;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
#[Title('Blog Page')]

class BlogPage extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $categories;

    protected $queryString = ['search', 'selectedCategory'];

    public function mount()
    {
        $this->categories = Category::whereHas('blogs', function($query) {
            $query->published();
        })->withCount(['blogs' => function($query) {
            $query->published();
        }])->orderBy('blogs_count', 'desc')->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->dispatch('scroll-to-results');
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
        $this->dispatch('scroll-to-results');
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->resetPage();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }

    public function render()
    {
        $blogs = Blog::with(['category', 'author', 'featuredImage'])
            ->published()
            ->when($this->search, function ($query) {
                $query->search($this->search);
            })
            ->when($this->selectedCategory, function ($query) {
                $query->byCategory($this->selectedCategory);
            })
            ->latest()
            ->paginate(6);
        
        return view('livewire.public.blog.blog-page', [
            'blogs' => $blogs,
        ]);
    }
}
