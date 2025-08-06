<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageKitHelper;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'description'
    ];

    protected $casts = [
        'value' => 'string',
    ];

    /**
     * Get a setting value by key with automatic default fallback
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        
        // If setting exists, return its value
        if ($setting) {
            return $setting->value;
        }
        
        // If no custom default provided, try to get from predefined defaults
        if ($default === null) {
            $defaults = static::getDefaults();
            $default = $defaults[$key] ?? null;
        }
        
        return $default;
    }

    /**
     * Set a setting value by key
     */
    public static function set($key, $value, $group = 'general', $type = 'string', $description = null)
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
                'description' => $description
            ]
        );
    }

    /**
     * Get all settings grouped by group
     */
    public static function getAllGrouped()
    {
        return static::all()->groupBy('group');
    }

    /**
     * Get settings by group
     */
    public static function getByGroup($group)
    {
        return static::where('group', $group)->get()->pluck('value', 'key');
    }

    /**
     * Upload logo using ImageKit
     */
    public static function uploadLogo($file)
    {
        if (!$file) {
            return null;
        }

        // Delete old logo if exists
        $oldLogo = static::get('site_logo_file_id');
        if ($oldLogo) {
            ImageKitHelper::deleteImage($oldLogo);
        }

        // Upload new logo
        $upload = ImageKitHelper::uploadImage($file, 'logos');
        
        if ($upload) {
            static::set('site_logo', $upload['url'], 'general', 'image', 'Website logo URL');
            static::set('site_logo_file_id', $upload['fileId'], 'general', 'string', 'ImageKit file ID for logo');
            return $upload;
        }

        return null;
    }

    /**
     * Get all settings with defaults applied
     */
    public static function getAllWithDefaults()
    {
        $defaults = static::getDefaults();
        $settings = static::all()->pluck('value', 'key')->toArray();
        
        // Merge defaults with actual settings, giving priority to actual settings
        return array_merge($defaults, $settings);
    }

    /**
     * Get settings by group with defaults applied
     */
    public static function getByGroupWithDefaults($group)
    {
        $allDefaults = static::getDefaults();
        $actualSettings = static::where('group', $group)->get()->pluck('value', 'key')->toArray();
        
        // Filter defaults to only include those that might belong to this group
        // For now, we'll return all defaults merged with actual settings
        return array_merge($allDefaults, $actualSettings);
    }

    /**
     * Get multiple settings at once with defaults
     */
    public static function getMultiple(array $keys)
    {
        $result = [];
        foreach ($keys as $key) {
            $result[$key] = static::get($key);
        }
        return $result;
    }

    /**
     * Get default settings
     */
    public static function getDefaults()
    {
        return [
            'site_name' => 'Zuppie',
            'site_logo' => '/images/logo.jpeg',
            'site_logo_file_id' => null,
            'email' => 'info@zuppie.com',
            'phone_no' => '+91 9999999990',
            'address' => 'Madhubani Bazaar Purnia, 854301',
            'instagram_link' => 'https://instagram.com',
            'facebook_link' => 'https://facebook.com',
            'site_description' => 'Creating unforgettable events with perfect planning.',
            'site_tagline' => 'Your Perfect Event Partner',
            'contact_form_email' => 'contact@zuppie.com',
            'business_hours' => 'Mon-Sat: 9AM-6PM',
            'whatsapp_number' => '+91 9123456789',
            'youtube_link' => '',
            'twitter_link' => '',
            'linkedin_link' => '',
        ];
    }

    /**
     * Seed default settings
     */
    public static function seedDefaults()
    {
        $defaults = static::getDefaults();
        
        foreach ($defaults as $key => $value) {
            if (!static::where('key', $key)->exists()) {
                $group = 'general';
                $type = 'string';
                $description = ucfirst(str_replace('_', ' ', $key));

                if ($key === 'site_logo') {
                    $type = 'image';
                    $description = 'Website logo';
                } elseif (str_contains($key, 'link')) {
                    $type = 'url';
                    $description = ucfirst(str_replace(['_', 'link'], [' ', ' link'], $key));
                } elseif ($key === 'email') {
                    $type = 'email';
                    $description = 'Contact email address';
                } elseif ($key === 'phone_no') {
                    $type = 'phone';
                    $description = 'Contact phone number';
                } elseif ($key === 'address') {
                    $type = 'textarea';
                    $description = 'Business address';
                }

                static::set($key, $value, $group, $type, $description);
            }
        }
    }
}
