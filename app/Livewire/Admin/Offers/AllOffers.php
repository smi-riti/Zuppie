<?php

namespace App\Livewire\Admin\Offers;

use App\Helpers\ImageKitHelper;
use App\Models\Offer;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class AllOffers extends Component
{

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.offers.all-offers',[
            'offers' => Offer::all(),
        ]);
    }
}
