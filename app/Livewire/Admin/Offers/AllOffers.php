<?php

namespace App\Livewire\Admin\Offers;

use App\Helpers\ImageKitHelper;
use App\Models\Offer;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AllOffers extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingDeletion = false;
    public $offerToDelete = null;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[On('offer-saved')]
    public function refreshComponent()
    {
        $this->resetPage();
    }

    public function confirmDelete($offerId)
    {
        $this->confirmingDeletion = true;
        $this->offerToDelete = $offerId;
    }

    public function deleteOffer()
    {
        if ($this->offerToDelete) {
            $offer = Offer::find($this->offerToDelete);
            if ($offer) {
                if ($offer->image_file_id) {
                    ImageKitHelper::deleteImage($offer->image_file_id);
                }
                $offer->delete();
                session()->flash('message', 'Offer deleted successfully!');
            }
        }

        $this->confirmingDeletion = false;
        $this->offerToDelete = null;
        $this->resetPage();
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
        $this->offerToDelete = null;
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $offers = Offer::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('offer_code', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        })->latest()->paginate(10);

        return view('livewire.admin.offers.all-offers', [
            'offers' => $offers,
        ]);
    }
}
