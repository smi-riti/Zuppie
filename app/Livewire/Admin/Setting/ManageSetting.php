<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
#[Title('Manage Settings')]

#[Layout('components.layouts.admin')]
class ManageSetting extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public $site_name = '';

    #[Validate('nullable|string|max:500')]
    public $site_description = '';

    #[Validate('nullable|image|max:2048')]
    public $logo_file;
    public $current_logo = '';
    #[Validate('required|email|max:255')]
    public $email = '';

    #[Validate('required|string|max:20')]
    public $phone_no = '';

    #[Validate('required|string|max:500')]
    public $address = '';

    #[Validate('nullable|url|max:255')]
    public $instagram_link = '';

    #[Validate('nullable|url|max:255')]
    public $facebook_link = '';

    #[Validate('nullable|url|max:255')]
    public $twitter_link = '';

    #[Validate('nullable|url|max:255')]
    public $linkedin_link = '';

    public $preview_logo = null;

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $this->site_name = Setting::get('site_name');
        $this->site_description = Setting::get('site_description');
        $this->current_logo = Setting::get('site_logo');
        $this->email = Setting::get('email');
        $this->phone_no = Setting::get('phone_no');
        $this->address = Setting::get('address');
        $this->instagram_link = Setting::get('instagram_link');
        $this->facebook_link = Setting::get('facebook_link');
        $this->twitter_link = Setting::get('twitter_link');
        $this->linkedin_link = Setting::get('linkedin_link');
    }

    public function updatedLogoFile()
    {
        $this->validate([
            'logo_file' => 'image|max:2048', // 2MB Max
        ]);

        if ($this->logo_file) {
            $this->preview_logo = $this->logo_file->temporaryUrl();
        }
    }

    public function removeLogoPreview()
    {
        $this->logo_file = null;
        $this->preview_logo = null;
    }

    public function save()
    {
        $this->validate();

        try {
            if ($this->logo_file) {
                $upload = Setting::uploadLogo($this->logo_file);
                if (!$upload) {
                    session()->flash('error', 'Failed to upload logo. Please try again.');
                    return;
                }
            }

            Setting::set('site_name', $this->site_name, 'general', 'string', 'Website name');
            Setting::set('site_description', $this->site_description, 'general', 'textarea', 'Website description');
            Setting::set('email', $this->email, 'general', 'email', 'Contact email');
            Setting::set('phone_no', $this->phone_no, 'general', 'phone', 'Contact phone number');
            Setting::set('address', $this->address, 'general', 'textarea', 'Business address');
            Setting::set('instagram_link', $this->instagram_link, 'general', 'url', 'Instagram profile link');
            Setting::set('facebook_link', $this->facebook_link, 'general', 'url', 'Facebook page link');
            Setting::set('twitter_link', $this->twitter_link, 'general', 'url', 'Twitter profile link');
            Setting::set('linkedin_link', $this->linkedin_link, 'general', 'url', 'LinkedIn profile link');

            $this->loadSettings();
            $this->preview_logo = null;
            $this->logo_file = null;

            session()->flash('message', 'Settings updated successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update settings: ' . $e->getMessage());
        }
    }

    public function resetToDefaults()
    {
        $defaults = Setting::getDefaults();
        
        $this->site_name = $defaults['site_name'];
        $this->site_description = $defaults['site_description'];
        $this->email = $defaults['email'];
        $this->phone_no = $defaults['phone_no'];
        $this->address = $defaults['address'];
        $this->instagram_link = $defaults['instagram_link'];
        $this->facebook_link = $defaults['facebook_link'];
        $this->twitter_link = $defaults['twitter_link'];
        $this->linkedin_link = $defaults['linkedin_link'];
        
        session()->flash('message', 'Settings reset to defaults. Click Save to apply changes.');
    }

    public function render()
    {
        return view('livewire.admin.setting.manage-setting');
    }
}
