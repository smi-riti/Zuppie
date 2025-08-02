<?php

namespace App\Livewire\Admin\Offers;

use App\Helpers\ImageKitHelper;
use App\Models\Offer;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

#[Title('Update Offer')]
class Update extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $offer, $offerId;
    public $title, $offer_code, $image, $description, $discount_type, $discount_value, $start_date, $end_date, $is_active;
    public $currentImageUrl = null;

    #[On('edit-offer')]
    public function showModal($id)
    {
        $this->resetExcept('showModal');
        $this->offer = Offer::findOrFail($id);
        $this->offerId = $this->offer->id;
        $this->title = $this->offer->title;
        $this->offer_code = $this->offer->offer_code;
        $this->currentImageUrl = $this->offer->image;
        $this->discount_type = $this->offer->discount_type;
        $this->discount_value = $this->offer->discount_value;
        $this->start_date = $this->offer->start_date;
        $this->end_date = $this->offer->end_date;
        $this->is_active = $this->offer->is_active;
        $this->description = $this->offer->description;
        $this->image = null; // Reset for new upload
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->reset();
        $this->showModal = false;
    }

    protected function rules()
    {
        $today = now()->toDateString();
        $startDate = $this->start_date ?: $today;
        
        return [
            'title' => 'required|string|max:255',
            'offer_code' => 'required|string|max:50|unique:offers,offer_code,' . $this->offerId,
            'discount_type' => 'required|in:flat,percent',
            'discount_value' => 'required|numeric|min:0|max:' . ($this->discount_type === 'percent' ? '100' : '999999'),
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:' . $startDate,
            'description' => 'nullable|string|max:1000',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function generateCodeFromTitle()
    {
        if ($this->title) {
            // Generate code from title
            $code = strtoupper(Str::slug($this->title, ''));
            $code = substr($code, 0, 10); // Limit to 10 characters
            
            // Check if code exists and add random suffix if needed
            $baseCode = $code;
            $counter = 1;
            while (Offer::where('offer_code', $code)->where('id', '!=', $this->offerId)->exists()) {
                $code = $baseCode . $counter;
                $counter++;
            }
            
            $this->offer_code = $code;
        }
    }

    public function updatedTitle()
    {
        $this->generateCodeFromTitle();
    }

    protected $messages = [
        'title.required' => 'Offer title is required.',
        'offer_code.required' => 'Offer code is required.',
        'offer_code.unique' => 'This offer code already exists.',
        'discount_type.required' => 'Please select a discount type.',
        'discount_value.required' => 'Discount value is required.',
        'discount_value.max' => 'Percentage discount cannot exceed 100%.',
        'start_date.required' => 'Start date is required.',
        'start_date.after_or_equal' => 'Start date must be today or later.',
        'end_date.required' => 'End date is required.',
        'end_date.after' => 'End date must be after start date.',
        'is_active.required' => 'Please select offer status.',
        'image.image' => 'Please upload a valid image file.',
        'image.max' => 'Image size must be less than 2MB.',
    ];

    public function updateOffer()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'offer_code' => $this->offer_code,
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
            'is_active' => $this->is_active,
        ];

        // Handle image upload using ImageKitHelper
        if ($this->image) {
            $imageData = ImageKitHelper::uploadImage($this->image, '/Zuppie/offer_images');
            
            if ($imageData) {
                // Delete old image if exists
                if ($this->offer->image_file_id) {
                    ImageKitHelper::deleteImage($this->offer->image_file_id);
                }
                
                $data['image'] = $imageData['url'];
                $data['image_file_id'] = $imageData['fileId'];
            } else {
                session()->flash('error', 'Failed to upload image. Please try again.');
                return;
            }
        }

        try {
            $offer = Offer::findOrFail($this->offerId);
            $offer->update($data);

            session()->flash('message', 'Offer updated successfully!');
            $this->closeModal();
            
            // Dispatch event to refresh the parent component
            $this->dispatch('offer-saved');
            
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.offers.update');
    }
}