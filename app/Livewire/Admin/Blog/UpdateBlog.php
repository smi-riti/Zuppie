<?php

namespace App\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\Category;
use App\Helpers\ImageKitHelper;
use Livewire\Component;
use ImageKit\ImageKit;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
#[Title('Update Blog')]
#[Layout('components.layouts.admin')]
class UpdateBlog extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $blogId;
    public $blog;
    public $images = [];
    public $categories;
    public $form = [
        'title' => '',
        'content' => '',
        'status' => 'draft',
        'category_id' => null,
    ];

    protected $rules = [
        'form.title' => 'required|string|max:255|unique:blogs,title',
        'form.content' => 'required|string',
        'form.status' => 'required|in:draft,published',
        'form.category_id' => 'nullable|exists:categories,id',
        'images.*' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    #[On('open-update-blog-modal')]
    public function openModal($id)
    {
        $this->blogId = $id;
        $this->blog = Blog::with(['images', 'featuredImage', 'galleryImages'])->findOrFail($id);
        
        $this->form = [
            'title' => $this->blog->title,
            'content' => $this->blog->content,
            'status' => $this->blog->status,
            'category_id' => $this->blog->category_id,
        ];
        
        $this->images = []; // Reset file input
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function updatedFormTitle($value)
    {
        // Slug will be auto-generated in the model
    }

    public function toggleStatus()
    {
        $this->form['status'] = $this->form['status'] === 'published' ? 'draft' : 'published';
    }

    public function updateBlog()
    {
        $this->rules['form.title'] = 'required|string|max:255|unique:blogs,title,' . $this->blogId;
        $this->validate();

        try {
            $blog = Blog::findOrFail($this->blogId);
            
            // Update blog data
            $blog->update([
                'title' => $this->form['title'],
                'content' => $this->form['content'],
                'status' => $this->form['status'],
                'category_id' => $this->form['category_id'] ?: null,
            ]);

            // Handle new image uploads
            if (!empty($this->images)) {
                // Get current max sort order
                $maxSortOrder = BlogImage::where('blog_id', $blog->id)->max('sort_order') ?? 0;
                
                foreach ($this->images as $index => $image) {
                    $uploadResult = ImageKitHelper::uploadImage($image, 'Zuppie/Blogs');
                    
                    if ($uploadResult) {
                        // If this is the first image and there's no featured image, make it featured
                        $isFeatured = $index === 0 && !$blog->featuredImage;
                        
                        BlogImage::create([
                            'blog_id' => $blog->id,
                            'image_url' => $uploadResult['url'],
                            'image_file_id' => $uploadResult['fileId'],
                            'is_featured' => $isFeatured,
                            'sort_order' => $maxSortOrder + $index + 1,
                        ]);
                    }
                }
            }

            $this->showModal = false;
            $this->resetForm();
            
            // Dispatch event to refresh the blog list
            $this->dispatch('blog-updated');
            $this->dispatch('refreshBlogList');
            session()->flash('success', 'Blog updated successfully!');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update blog: ' . $e->getMessage());
        }
    }

    private function resetForm()
    {
        $this->form = [
            'title' => '',
            'content' => '',
            'status' => 'draft',
            'category_id' => null,
        ];
        $this->images = [];
        $this->blog = null;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.blog.update-blog');
    }
}