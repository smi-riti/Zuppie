<?php

namespace App\Livewire\Public\Section;

use App\Traits\HasSettings;
use Livewire\Component;
#[Title('About Us')]

class About extends Component
{
    use HasSettings;

    public $settings = [];

    public function mount()
    {
        $this->loadSiteSettings([
            'site_name',
            'site_description', 
            'email',
            'phone_no',
            'address',
            'about_description',
            'mission_statement',
            'vision_statement',
            'team_description',
            'instagram_link',
            'facebook_link',
            'youtube_link',
            'twitter_link',
            'linkedin_link'
        ]);
    }

    public function render()
    {
        return view('livewire.public.section.about');
    }
}
