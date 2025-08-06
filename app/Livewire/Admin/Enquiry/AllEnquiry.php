<?php

namespace App\Livewire\Admin\Enquiry;

use App\Models\Enquiry;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AllEnquiry extends Component
{
    
    public $activeTab = 'All Enquiries';
    public $enquiries;

     public function mount()
    {
        $this->enquiries = Enquiry::all();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.enquiry.all-enquiry');
    }
}
