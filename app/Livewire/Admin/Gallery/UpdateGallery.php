<?php

namespace App\Livewire\Admin\Gallery;
use App\Models\GalleryImage;
use Livewire\Component;
use Livewire\WithFileUploads;
use ImageKit\ImageKit;
use App\Models\Category; // Add this

class UpdateGallery extends Component
{
    use WithFileUploads;

    public $imageId;
    public $galleryImage;
    public $uploadedImage;
    public $alt;
    public $category_id;
    public $description;
    public $categories;

    public function mount($imageId)
    {
        $this->imageId = $imageId;
        $this->galleryImage = GalleryImage::findOrFail($imageId);
        $this->alt = $this->galleryImage->alt;
        $this->category_id = $this->galleryImage->category_id;
        $this->description = $this->galleryImage->description;
        $this->categories = Category::all();
    }

    public function save()
    {
        $this->validate([
            'alt' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'uploadedImage' => 'nullable|image|max:2048',
        ]);

        $data = [
            'alt' => $this->alt,
            'category_id' => $this->category_id,
            'description' => $this->description,
        ];

        if ($this->uploadedImage) {
            $uploadResult = $this->uploadToImageKit($this->uploadedImage);
            
            if ($uploadResult) {
                $data['filename'] = $uploadResult['url'];
                $data['file_id'] = $uploadResult['fileId'];
            }
        }

        $this->galleryImage->update($data);

        $this->dispatch('image-updated'); // Updated event dispatch
        session()->flash('message', 'Image updated successfully!');
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
                'folder' => 'Zuppie/gallery/',
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

    public function closeModal()
    {
        $this->dispatch('close-modal'); // Dispatch event to parent
    }

    public function render()
    {
        return view('livewire.admin.gallery.update-gallery');
    }
}