<?php

namespace App\Livewire\Public\Section;

use App\Models\Category;
use App\Models\Enquiry;
use Livewire\Attributes\On;
use Livewire\Component;

class EnquiryForm extends Component
{
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
        'formData.phone' => 'required|string|min:10|max:10|regex:/^[6-9]\d{9}$/'
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
        Enquiry::create([
            'event_type' => $this->formData['event_type'],
            'budget' => $this->formData['budget'],
            'message' => $this->formData['message'],
            'fullname' => $this->formData['fullname'],
            'email' => $this->formData['email'],
            'phone' => $this->formData['phone'],
        ]);
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
