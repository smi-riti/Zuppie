<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use App\Models\Blog;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

class ManageBlog extends Component
{
    use WithPagination;

    public $confirmingDeletion = false;
    public $blogToDelete = null;
    public $search = '';
    public $perPage = 7;
    public $isLoading = false;

    protected $queryString = ['search' => ['except' => ''], 'perPage'];

    public function updatingSearch()
    {
        $this->isLoading = true;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->isLoading = false;
    }

    public function confirmDelete($blogId)
    {
        $this->confirmingDeletion = true;
        $this->blogToDelete = $blogId;
    }

    public function deleteBlog()
    {
        if ($this->blogToDelete) {
            $this->isLoading = true;
            $blog = Blog::find($this->blogToDelete);
            if ($blog) {
                $blog->delete();
            }
            $this->isLoading = false;
        }

        $this->confirmingDeletion = false;
        $this->blogToDelete = null;
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
        $this->blogToDelete = null;
    }

    public function refresh()
    {
        $this->isLoading = true;
        $this->resetPage();
        $this->isLoading = false;
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $blogs = Blog::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('slug', 'like', '%' . $this->search . '%');
        })
        ->latest()
        ->paginate($this->perPage);

        return view('livewire.admin.blog.manage-blog', [
            'blogs' => $blogs
        ]);
    }
}