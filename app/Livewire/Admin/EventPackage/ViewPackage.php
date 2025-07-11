<?php

namespace App\Livewire\Admin\EventPackage;

use App\Models\EventPackage;
use Livewire\Component;
use App\Helpers\ImageKitHelper;

class ViewPackage extends Component
{
    public $package;
    public $showDeleteImageModal = false;
    public $imageToDelete;

    public function mount($packageId)
    {
        $this->package = EventPackage::with(['category', 'images'])->findOrFail($packageId);
    }

    public function confirmDeleteImage($imageId)
    {
        $this->imageToDelete = $imageId;
        $this->showDeleteImageModal = true;
    }

    public function deleteImage()
    {
        $image = \App\Models\EventPackageImage::find($this->imageToDelete);
        if ($image) {
            // We're using soft delete now, so we don't need to delete from ImageKit
            // Just soft delete the image
            $image->delete();
            
            // Refresh the package data safely
            if ($this->package && $this->package->id) {
                $this->package = EventPackage::with(['category', 'images'])->find($this->package->id);
            }
            $this->showDeleteImageModal = false;
            
            session()->flash('message', 'Image deleted successfully!');
        }
    }

    public function closeViewModal()
    {
        $this->dispatch('closeViewModal');
    }

    public function render()
    {
        return view('livewire.admin.event-package.view-package');
    }
}
