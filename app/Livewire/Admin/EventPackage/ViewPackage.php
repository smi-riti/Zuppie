<?php

namespace App\Livewire\Admin\EventPackage;

use App\Models\EventPackage;
use Livewire\Component;
use App\Helpers\ImageKitHelper;
#[Title('View Packages')]

class ViewPackage extends Component
{
    public $package;
    public $showDeleteImageModal = false;
    public $imageToDelete;

    public function mount($packageId)
    {
        $this->package = EventPackage::with(['category', 'images'])->findOrFail($packageId);
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
