<?php

namespace App\Livewire\Public\Section;

use App\Models\Category;
use App\Traits\HasSettings;
use Livewire\Component;

class Contact extends Component
{
    use HasSettings;

    public function mount()
    {
        // Load contact-related settings
        $this->loadSiteSettings([
            'site_name',
            'email',
            'phone_no',
            'address',
            'contact_form_email',
            'business_hours',
            'whatsapp_number',
            'instagram_link',
            'facebook_link',
            'youtube_link',
            'twitter_link',
            'linkedin_link',
            'site_description'
        ]);
    }
    
    public function render()
    {
        return view('livewire.public.section.contact');
    }
}
