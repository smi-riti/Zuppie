<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use App\Models\Blog;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
#[Title('Manage Blog')]
class ManageBlog extends Component
{
    use WithPagination;

    public $confirmingDeletion = false;
    public $blogToDelete = null;
    public $search = '';
    public $perPage = 6;
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

    public function viewBlog($blogId)
    {
        $this->dispatch('open-view-blog-modal', id: $blogId);
    }

    public function toggleStatus($blogId)
    {
        $blog = Blog::find($blogId);
        if ($blog) {
            $blog->status = $blog->status === 'published' ? 'draft' : 'published';
            $blog->save();
            session()->flash('success', 'Blog status updated successfully!');
        }
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

    #[On('refreshBlogList')]
    #[On('blog-created')]
    #[On('blog-updated')]
    public function refreshList()
    {
        $this->refresh();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $blogs = Blog::with(['featuredImage', 'category'])
        ->when($this->search, function ($query) {
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