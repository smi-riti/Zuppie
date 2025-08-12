<?php

namespace App\Livewire\Admin\Enquiry;

use App\Models\Enquiry;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class AllEnquiry extends Component
{
    
    public $showViewModal = false;
    public $enquiryIdToView;

    public $listeners = [
        'closeViewModal' => 'closeViewModal',
    ];
    public function openEnquiryViewModal($enquiryId)
    {
        $this->enquiryIdToView = $enquiryId;
        $this->showViewModal = true;
    }
   public function closeViewModal()
    {
        $this->showViewModal = false;
    }
    
    public $activeTab = 'All Enquiries';
    public $enquiries, $resolvedEnquiry;

     public function mount()
    {
        $this->enquiries = Enquiry::where('status', 'pending')->get();
        $this->resolvedEnquiry = Enquiry::where('status', 'resolved')->get();
    }
    #[On('query-updated')]
    public function refreshComponent(){
        $this->resetPage();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.enquiry.all-enquiry');
    }
}
