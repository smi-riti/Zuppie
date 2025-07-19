<?php

namespace App\Traits;

use App\Models\Setting;

trait HasSettings
{
    public $settings = [];

    public function initializeHasSettings()
    {
        $this->loadSiteSettings();
    }

    public function loadSiteSettings(array $keys = null)
    {
        if ($keys === null) {
            // Load commonly used settings
            $keys = [
                'site_name',
                'site_logo',
                'site_description',
                'email',
                'phone_no',
                'address',
                'instagram_link',
                'facebook_link',
                'youtube_link',
                'twitter_link',
                'linkedin_link'
            ];
        }

        $this->settings = Setting::getMultiple($keys);
    }

    public function getSetting($key, $default = null)
    {
        return $this->settings[$key] ?? Setting::get($key, $default);
    }
}
