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

 #[Layout('components.layouts.admin')]
class CreateBlog extends Component
{
    use WithFileUploads;

    public $showModal = false;
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

    protected $messages = [
        'form.title.required' => 'The blog title is required.',
        'form.title.unique' => 'This blog title already exists.',
        'form.content.required' => 'Blog content is required.',
        'form.status.required' => 'Blog status is required.',
        'form.category_id.exists' => 'Selected category is invalid.',
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function updatedFormTitle($value)
    {
        // Slug will be auto-generated in the model
    }

    public function toggleStatus()
    {
        $this->form['status'] = $this->form['status'] === 'published' ? 'draft' : 'published';
    }

    public function resetForm()
    {
        $this->form = [
            'title' => '',
            'content' => '',
            'status' => 'draft',
            'category_id' => null,
        ];
        $this->images = [];
        $this->resetValidation();
    }

    #[On('open-create-blog-modal')]
    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function saveBlog()
    {
        $this->validate();
        // dd($this->validate());
        try {
            // Create the blog
            $blog = Blog::create([
                'title' => $this->form['title'],
                'content' => $this->form['content'],
                'status' => $this->form['status'],
                'user_id' => auth()->id(),
                'category_id' => $this->form['category_id'] ?: null,
            ]);

            // Handle image uploads
            if (!empty($this->images)) {
                foreach ($this->images as $index => $image) {
                    $uploadResult = ImageKitHelper::uploadImage($image, 'Zuppie/Blogs');
                    
                    if ($uploadResult) {
                        BlogImage::create([
                            'blog_id' => $blog->id,
                            'image_url' => $uploadResult['url'],
                            'image_file_id' => $uploadResult['fileId'],
                            'is_featured' => $index === 0, // First image is featured
                            'sort_order' => $index + 1,
                        ]);
                    }
                }
            }

            $this->showModal = false;
            $this->resetForm();
            
            // Dispatch event to refresh the blog list
            $this->dispatch('blog-created');
            $this->dispatch('refreshBlogList');
            session()->flash('success', 'Blog created successfully!');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create blog: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.blog.create-blog');
    }
}