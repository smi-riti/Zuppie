<?php

namespace App\Livewire\Admin\Offers;

use App\Helpers\ImageKitHelper;
use App\Models\Offer;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOffer extends Component
{
    use WithFileUploads;
    public $showModal = false;
    public $title, $offer_code, $discount_type, $discount_value, $start_date, $end_date, $image, $description;

    #[On('open-create-offer-modal')]
    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'offer_code' => 'unique:offers,offer_code|string|max:50',
        'discount_type' => 'required|in:percent,flat',
        'discount_value' => 'required|numeric|min:0',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'description' => 'nullable|string|max:1000',
        'image' => 'nullable|image|max:2048',
    ];


    public function createOffer()
    {
        $this->validate();

        // Upload image if present
        $imageData = null;
        if ($this->image) {
            $imageData = ImageKitHelper::uploadImage($this->image, 'offers');

            if (!$imageData) {
                session()->flash('error', 'Failed to upload image. Please try again.');
                return;
            }
        }

        Offer::create([
            'event_package_id' => 1,
            'title' => $this->title,
            'offer_code' => $this->offer_code,
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
            'is_active' => true,
            'image' => $imageData['url'] ?? null,  // Store the image URL
            'image_file_id' => $imageData['fileId'] ?? null, // Store the ImageKit file ID
        ]);

        $this->reset([
            'title',
            'offer_code',
            'discount_type',
            'discount_value',
            'start_date',
            'end_date',
            'description',
            'image'
        ]);

        session()->flash('message', 'Offer created successfully.');
        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.admin.offers.create-offer');
    }
}
