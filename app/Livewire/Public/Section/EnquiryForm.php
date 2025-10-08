<?php

namespace App\Livewire\Public\Section;

use App\Helpers\ImageKitHelper;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\enquiry_images;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
#[Title('Enquiry Form')]

class EnquiryForm extends Component
{
    use WithFileUploads;

    public $images = [];

    public $showModal = false;

    #[On('open-enquiry-form')]
    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }


    public $formData = [
        'event_type' => '',
        'budget' => 1000,
        'message' => '',
        'fullname' => '',
        'email' => '',
        'phone' => '',
    ];

    protected $rules = [
        'formData.event_type' => 'required|string',
        // 'formData.budget' => 'nullable',
        'formData.message' => 'required|string',
        'formData.fullname' => 'required|string|max:255',
        'formData.email' => 'nullable|email|max:255',
        'formData.phone' => 'required|string|min:10|max:10|regex:/^[6-9]\d{9}$/',
        'images.*' => 'nullable|image|max:2048',

    ];

    protected $messages = [
        'formData.message.required' => 'please enter a enquiry message',
        'formData.fullname.required' => 'please enter your full name',
        'formData.phone.required' => 'please enter your phone number',
        'formData.phone.regex' => 'please enter valid phone number',
        'formData.phone.min' => 'please enter valid phone number',
    ];


    public function captureEnquiry()
    {
        $this->validate();

        // Save to database
        $enquiry = Enquiry::create([
            'event_type' => $this->formData['event_type'],
            'budget' => $this->formData['budget'],
            'message' => $this->formData['message'],
            'fullname' => $this->formData['fullname'],
            'email' => $this->formData['email'],
            'phone' => $this->formData['phone'],
        ]);
         $imageUrls = [];
        $imageFileIds = [];

        if ($this->images && is_array($this->images)) {
            foreach ($this->images as $image) {
                try {
                    $uploadResult = ImageKitHelper::uploadImage(
                        $image,
                        '/Zuppie/EnquiryImages/' // Your custom folder
                    );

                    if ($uploadResult) {
                        $imageUrls[] = $uploadResult['url'];
                        $imageFileIds[] = $uploadResult['fileId'];
                    } else {
                        session()->flash('error', 'Failed to upload one or more images');
                        return;
                    }
                } catch (\Exception $e) {
                    \Log::error('Image upload error: ' . $e->getMessage());
                    session()->flash('error', 'Image upload failed: ' . $e->getMessage());
                    return;
                }
            }
        }

        foreach ($imageUrls as $key => $imageUrl) {
            enquiry_images::create([
                'enquiry_id' => $enquiry->id,
                'image_url' => $imageUrl,
                'image_file_id' => $imageFileIds[$key],
            ]);
        }
        $this->formData = [
            'event_type' => '',
            'budget' => 1000,
            'message' => '',
            'fullname' => '',
            'email' => '',
            'phone' => '',
        ];

        $this->currentField = 'event_type';

        // Show success message
        session()->flash('message', 'Your enquiry has been submitted successfully!');

        $this->closeModal();
    }

    public function render()
    {
        $parentCategory = Category::all();
        return view('livewire.public.section.enquiry-form', compact('parentCategory'));
    }
}
