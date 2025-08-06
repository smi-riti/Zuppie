<?php

namespace App\Livewire\Admin\Gallery;

use App\Models\GalleryImage;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use ImageKit\ImageKit;
use App\Helpers\ImageKitHelper;

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

        $uploadedImages = [];
        foreach ($this->images as $image) {
            if ($image) {
                $upload = ImageKitHelper::uploadImage($image, '/Zuppie/gallery');
                if ($upload) {
                    $uploadedImages[] = [
                        'filename' => $upload['url'],
                        'file_id' => $upload['fileId'],
                        'alt' => $this->alt,
                        'category_id' => $this->category_id,
                        'description' => $this->description,
                    ];
                }
            }
        }

        if (!empty($uploadedImages)) {
            GalleryImage::insert($uploadedImages);
        }

        $this->reset(['images', 'alt', 'category_id', 'description']);
        $this->dispatch('gallery-created');

        session()->flash('message', 'Images uploaded successfully!');
        return redirect()->route('gallery.manage');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->dispatch('close-modal', type: 'create');
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