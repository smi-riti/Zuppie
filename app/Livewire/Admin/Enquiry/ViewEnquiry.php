<?php

namespace App\Livewire\Admin\Enquiry;

use App\Models\Enquiry;
use Livewire\Component;

class ViewEnquiry extends Component
{
    public $showViewModal = false;
    public $enquiryDetails;

    public function mount($enquiryId){
        $this->enquiryDetails = Enquiry::find($enquiryId);
    }

public function markResolved($queryId){
    $enquiry = Enquiry::find($queryId);
    if ($enquiry) {
        $enquiry->status = 'resolved';
        $enquiry->save();
        $this->dispatch('closeViewModal');
        $this->dispatch('enquiryUpdated', $enquiry->id);
    }
}
    public function closeViewModal()
    {
        $this->dispatch('closeViewModal');
    }
    public function render()
    {
        return view('livewire.admin.enquiry.view-enquiry');
    }
}
