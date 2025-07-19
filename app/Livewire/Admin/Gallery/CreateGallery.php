<?php

namespace App\Livewire\Admin\Gallery;

use App\Models\GalleryImage;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use ImageKit\ImageKit;

class CreateGallery extends Component
{
    use WithFileUploads;

    public $images = [];
    public $alt = '';
    public $category_id = null;
    public $description = '';
    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    protected $rules = [
        'images.*' => 'required|image|max:2048',
        'alt' => 'nullable|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        'description' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        foreach ($this->images as $image) {
            $uploadResult = $this->uploadToImageKit($image);
            
            if ($uploadResult) {
                GalleryImage::create([
                    'filename' => $uploadResult['url'],
                    'file_id' => $uploadResult['fileId'],
                    'alt' => $this->alt,
                    'category_id' => $this->category_id,
                    'description' => $this->description,
                ]);
            }
        }

        $this->reset(['images', 'alt', 'category_id', 'description']);
        $this->dispatch('image-created'); 
        session()->flash('message', 'Images uploaded successfully!');

       
    }
public function closeModal()
{
    $this->dispatch('close-modal'); // Dispatch event to parent
}

    private function uploadToImageKit($image)
    {
        $publicKey = config('imagekit.public_key');
        $privateKey = config('imagekit.private_key');
        $urlEndpoint = config('imagekit.url_endpoint');

        if (empty($publicKey) || empty($privateKey) || empty($urlEndpoint)) {
            session()->flash('error', 'ImageKit credentials are not configured!');
            return null;
        }

        $imagekit = new ImageKit(
            $publicKey,
            $privateKey,
            $urlEndpoint
        );

        try {
            $response = $imagekit->upload([
                'file' => $image->getRealPath(),
                'fileName' => $image->getClientOriginalName(),
                'folder' => '/gallery/',
                'useUniqueFileName' => true,
            ]);

            return [
                'url' => $response->result->url,
                'fileId' => $response->result->fileId
            ];
        } catch (\Exception $e) {
            session()->flash('error', 'Image upload failed: ' . $e->getMessage());
            return null;
        }
    }

    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }


    public function render()
    {
        return view('livewire.admin.gallery.create-gallery');
    }
}