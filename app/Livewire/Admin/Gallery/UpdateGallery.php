<?php

namespace App\Livewire\Admin\Gallery;
use App\Models\GalleryImage;
use Livewire\Component;
use Livewire\WithFileUploads;
use ImageKit\ImageKit;
use App\Models\Category; // Add this
use App\Helpers\ImageKitHelper;

class UpdateGallery extends Component
{
    use WithFileUploads;

    public $galleryImage;
    public $image;
    public $alt;
    public $category_id;
    public $description;
    public $categories;
    public $existingImage;

    public function mount($id)  
    {
        $this->galleryImage = GalleryImage::findOrFail($id);
        $this->alt = $this->galleryImage->alt;
        $this->category_id = $this->galleryImage->category_id;
        $this->description = $this->galleryImage->description;
        $this->categories = Category::all();
        $this->existingImage = $this->galleryImage->filename;
    }


    protected $rules = [
        'image' => 'nullable|image|max:2048',
        'alt' => 'nullable|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        'description' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        $data = [
            'alt' => $this->alt,
            'category_id' => $this->category_id,
            'description' => $this->description,
        ];

        if ($this->image) {
            $upload = ImageKitHelper::uploadImage($this->image, '/Zuppie/gallery');
            
            if ($upload) {
                // Delete old image from ImageKit
                ImageKitHelper::deleteImage($this->galleryImage->file_id);
                
                $data['filename'] = $upload['url'];
                $data['file_id'] = $upload['fileId'];
            }
        }

        $this->galleryImage->update($data);

        session()->flash('message', 'Image updated successfully!');
        $this->dispatch('gallery-updated');
        $this->dispatch('close-edit-modal'); 
        return redirect()->route('gallery.manage'); 
        $this->closeModal();
    }   
    public function closeModal()
    {
        $this->dispatch('close-edit-modal');
    }

    public function removeImage()
    {
        $this->image = null;
    }


    public function render()
    {
        return view('livewire.admin.gallery.update-gallery');
    }
}