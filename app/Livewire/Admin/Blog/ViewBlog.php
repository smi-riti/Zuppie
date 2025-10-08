<?php

namespace App\Livewire\Admin\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\Attributes\On;
#[Title('View Blog')]
class ViewBlog extends Component
{
    public $showModal = false;
    public $blog;

    #[On('open-view-blog-modal')]
    public function openModal($id)
    {
        try {
            $this->blog = Blog::with(['category', 'author', 'featuredImage', 'galleryImages'])
                ->find($id);
            
            if ($this->blog) {
                $this->showModal = true;
            } else {
                session()->flash('error', 'Blog not found.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading blog: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->blog = null;
    }

    public function toggleStatus()
    {
        if ($this->blog) {
            $this->blog->status = $this->blog->status === 'published' ? 'draft' : 'published';
            $this->blog->save();
            session()->flash('success', 'Blog status updated successfully!');
            $this->dispatch('refreshBlogList');
        }
    }

    public function render()
    {
        return view('livewire.admin.blog.view-blog');
    }
}
