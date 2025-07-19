<?php

namespace App\Livewire\Admin\Blog;

use App\Models\Blog;
use Livewire\Component;
use ImageKit\ImageKit;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class UpdateBlog extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $blogId;
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

    #[On('open-update-blog-modal')]
    public function openModal($id)
    {
        $this->blogId = $id;
        $blog = Blog::findOrFail($id);
        
        $this->form = [
            'title' => $blog->title,
            'slug' => $blog->slug,
            'content' => $blog->content,
            'is_published' => $blog->is_published,
        ];
        
        $this->image = $blog->image;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function updatedFormTitle($value)
    {
        $this->form['slug'] = Str::slug($value);
    }

    public function updateBlog()
    {
        $this->rules['form.title'] = 'required|string|max:255|unique:blogs,title,' . $this->blogId;
        $this->rules['form.slug'] = 'required|string|max:255|unique:blogs,slug,' . $this->blogId;
        $this->validate();

        $blog = Blog::findOrFail($this->blogId);
        $imageUrl = $blog->image;
        $imageFileId = $blog->image_file_id;

        if ($this->image && !is_string($this->image)) {
            $uploadResult = $this->uploadToImageKit();
            if ($uploadResult) {
                $imageUrl = $uploadResult['url'];
                $imageFileId = $uploadResult['fileId'];
            }
        }

        $data = $this->form;
        $data['image'] = $imageUrl;
        $data['image_file_id'] = $imageFileId;

        $blog->update($data);

        $this->showModal = false;
        $this->resetForm();
        $this->dispatch('blog-updated');
        session()->flash('success', 'Blog updated successfully!');
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
        return view('livewire.admin.blog.update-blog');
    }
}