<?php
namespace App\Livewire\Admin\Offers;

use App\Models\Offer;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Update Offer')]
class Update extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $offer, $offerId;
    public $title, $offer_code, $image, $description, $discount_type, $discount_value, $start_date, $end_date, $is_active;

    #[On('edit-offer')]
    public function showModal($id)
    {
        $this->resetExcept('showModal'); // Reset all properties except showModal
        $this->offer = Offer::findOrFail($id);
        $this->offerId = $this->offer->id;
        $this->title = $this->offer->title;
        $this->offer_code = $this->offer->offer_code;
        $this->image = $this->offer->image;
        $this->discount_type = $this->offer->discount_type;
        $this->discount_value = $this->offer->discount_value;
        $this->start_date = $this->offer->start_date;
        $this->end_date = $this->offer->end_date;
        $this->is_active = $this->offer->is_active;
        $this->description = $this->offer->description;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->reset();
        $this->showModal = false;
    }

    public function updateOffer()
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'offer_code' => 'required|string|max:50',
            'discount_type' => 'required|in:flat,percent',
            'discount_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $offer = Offer::findOrFail($this->offerId);
        $offer->update($validated);

        session()->flash('message', 'Offer updated successfully!');
        $this->closeModal();
        
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.offers.update');
    }
}