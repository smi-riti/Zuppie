<?php

namespace App\Livewire\Public\Pages;

use App\Traits\HasSettings;
use Livewire\Component;

class TermsOfService extends Component
{
    use HasSettings;

    public $settings = [];

    public function mount()
    {
        $this->loadSiteSettings([
            'site_name',
            'email',
            'phone_no',
            'address',
            'terms_content',
            'last_updated_date'
        ]);
    }

    public function render()
    {
        return view('livewire.public.pages.terms-of-service');
    }
}
