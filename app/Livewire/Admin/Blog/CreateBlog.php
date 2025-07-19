<?php

namespace App\Livewire\Admin\Blog;

use App\Models\Blog;
use Livewire\Component;
use ImageKit\ImageKit;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class CreateBlog extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $image;
    public $form = [
        'title' => '',
        'slug' => '',
        'content' => '',
        'is_published' => false,
    ];

    protected $rules = [
        'form.title' => 'required|string|max:255|unique:blogs,title',
        'form.slug' => 'required|string|max:255|unique:blogs,slug',
        'form.content' => 'required|string',
        'form.is_published' => 'boolean',
        'image' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'form.title.required' => 'The blog title is required.',
        'form.title.unique' => 'This blog title already exists.',
        'form.slug.required' => 'The slug is required.',
        'form.slug.unique' => 'This slug already exists.',
        'form.content.required' => 'Blog content is required.',
    ];

    public function updatedFormTitle($value)
    {
        $this->form['slug'] = Str::slug($value);
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

        $imageUrl = null;
        $imageFileId = null;

        if ($this->image) {
            $uploadResult = $this->uploadToImageKit();
            if ($uploadResult) {
                $imageUrl = $uploadResult['url'];
                $imageFileId = $uploadResult['fileId'];
            }
        }

        $data = $this->form;
        if ($imageUrl) {
            $data['image'] = $imageUrl;
            $data['image_file_id'] = $imageFileId;
        }
        $data['user_id'] = auth()->id(); // Add this to set the user_id
        Blog::create($data);

        $this->showModal = false;
        $this->resetForm();
        $this->dispatch('blog-created');
        session()->flash('success', 'Blog created successfully!');
    }

    private function uploadToImageKit()
    {
        $publicKey = config('imagekit.public_key', env('IMAGEKIT_PUBLIC_KEY'));
        $privateKey = config('imagekit.private_key', env('IMAGEKIT_PRIVATE_KEY'));
        $urlEndpoint = config('imagekit.url_endpoint', env('IMAGEKIT_URL_ENDPOINT'));
        
        if (empty($publicKey) || empty($privateKey) || empty($urlEndpoint)) {
            session()->flash('error', 'ImageKit credentials are missing.');
            return null;
        }
        
        $imagekit = new ImageKit(
            $publicKey,
            $privateKey,
            $urlEndpoint
        );

        $localPath = $this->image->getRealPath();
        $fileName = $this->image->getClientOriginalName();

        $fileResource = fopen($localPath, 'r');
        if ($fileResource === false) {
            session()->flash('error', 'Failed to open image file for upload.');
            return null;
        }
        
        try {
            $response = $imagekit->upload([
                'file' => $fileResource,
                'fileName' => $fileName,
                'folder' => 'Zuppie/Blogs/',
                'useUniqueFileName' => true,
            ]);
        } finally {
            if (is_resource($fileResource)) {
                fclose($fileResource);
            }
        }

        if (isset($response->result) && !empty($response->result->url)) {
            return [
                'url' => $response->result->url,
                'fileId' => $response->result->fileId
            ];
        } else {
            $errorMsg = 'Image upload failed.';
            if (isset($response->error)) {
                $errorMsg .= ' ImageKit error: ' . json_encode($response->error);
            } else {
                $errorMsg .= ' No URL returned from ImageKit.';
            }
            session()->flash('error', $errorMsg);
            return null;
        }
    }

    private function resetForm()
    {
        $this->form = [
            'title' => '',
            'slug' => '',
            'content' => '',
            'is_published' => false,
        ];
        $this->image = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.blog.create-blog');
    }
}