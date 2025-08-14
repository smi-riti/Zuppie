<?php

namespace App\Livewire\Admin\Offers;

use App\Helpers\ImageKitHelper;
use App\Models\Offer;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
#[Title('Create Offer')]

class CreateOffer extends Component
{
    use WithFileUploads;
    
    public $showModal = false;
    public $title, $offer_code, $discount_type, $discount_value, $start_date, $end_date, $image, $description;

    #[On('open-create-offer-modal')]
    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function generateCodeFromTitle()
    {
        if ($this->title) {
            $code = strtoupper(Str::slug($this->title, ''));
            $code = substr($code, 0, 10); // Limit to 10 characters
            
            $baseCode = $code;
            $counter = 1;
            while (Offer::where('offer_code', $code)->exists()) {
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

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    protected function rules()
    {
        $today = now()->toDateString();
        $startDate = $this->start_date ?: $today;
        
        return [
            'title' => 'required|string|max:255',
            'offer_code' => 'required|string|max:50|unique:offers,offer_code',
            'discount_type' => 'required|in:percent,flat',
            'discount_value' => 'required|numeric|min:0|max:' . ($this->discount_type === 'percent' ? '100' : '999999'),
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:' . $startDate,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:2048',
        ];
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
        'image.image' => 'Please upload a valid image file.',
        'image.max' => 'Image size must be less than 2MB.',
    ];

    public function generateOfferCode()
    {
        $this->offer_code = 'OFFER' . strtoupper(Str::random(6));
    }

    public function createOffer()
    {
        $this->validate();

        $data = [
            'event_package_id' => 1,
            'title' => $this->title,
            'offer_code' => $this->offer_code,
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
            'is_active' => true,
        ];

        if ($this->image) {
            $imageData = ImageKitHelper::uploadImage($this->image, '/Zuppie/offer_images');

            if ($imageData) {
                $data['image'] = $imageData['url'];
                $data['image_file_id'] = $imageData['fileId'];
            } else {
                session()->flash('error', 'Failed to upload image. Please try again.');
                return;
            }
        }

        try {
            Offer::create($data);
            session()->flash('message', 'Offer created successfully!');
            $this->closeModal();

            $this->dispatch('offer-saved');
            
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
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
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.offers.create-offer');
    }
}
