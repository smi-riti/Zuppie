<?php

namespace App\Livewire\Public\Event;

use Livewire\Component;
use App\Models\EventPackage;
use App\Models\Service;

class PackageDetail extends Component
{
    public $packageId;
    public $package;
    public $pinCode = '';
    public $isPinCodeAvailable = null;
    public $checkingPinCode = false;
    public $showBookingForm = false;
    public $currentImageIndex = 0;

    public function mount($id = null)
    {
        $this->packageId = $id;
        $this->loadPackage();
    }

    public function loadPackage()
    {
        $this->package = EventPackage::with(['category', 'images'])
            ->where('id', $this->packageId)
            ->where('is_active', true)
            ->first();

        if (!$this->package) {
            return redirect()->route('event-packages')->with('error', 'Package not found');
        }
    }

    public function checkPinCodeAvailability()
    {
        $this->validate([
            'pinCode' => 'required|numeric|digits:6'
        ]);

        $this->checkingPinCode = true;
        
        // Simulate API call delay
        sleep(1);
        
        // Check if pin code exists in service model
        $service = Service::where('pin_code', $this->pinCode)->first();
        $this->isPinCodeAvailable = $service ? true : false;
        
        $this->checkingPinCode = false;

        if ($this->isPinCodeAvailable) {
            session()->flash('pin_message', 'Great! We provide services in your area.');
        } else {
            session()->flash('pin_error', 'Sorry, we don\'t provide services in this area yet.');
        }
    }

    public function bookNow()
    {
        if (!$this->isPinCodeAvailable) {
            session()->flash('error', 'Please check pin code availability first.');
            return;
        }

        // Store package and pin code data in session for booking form
        session([
            'package_id' => $this->packageId,
            'pin_code' => $this->pinCode,
            'pin_code_checked' => true
        ]);

        // Redirect to booking form with package and pin code data
        return redirect()->route('package-booking-form', [
            'package_id' => $this->packageId,
            'pin_code' => $this->pinCode
        ]);
    }

    public function getPackageImagesProperty()
    {
        if (!$this->package) return [];
        
        $images = $this->package->images->pluck('image_url')->toArray();
        
        // Add default images if no images available
        if (empty($images)) {
            $images = [
                'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
            ];
        }
        
        // Show all images in package detail
        return $images;
    }

    public function getPackageFeaturesProperty()
    {
        return [
            'Professional Event Planning & Coordination',
            'Complete Venue Setup & Decoration',
            'High-Quality Photography & Videography',
            'Premium Catering Services',
            'Entertainment & Music Management',
            'Guest Management & Coordination',
            'Lighting & Sound Setup',
            'Floral Arrangements & Centerpieces',
            'Custom Theme Design',
            '24/7 Event Support'
        ];
    }

    public function getSimilarPackagesProperty()
    {
        if (!$this->package || !$this->package->category) {
            return collect([]);
        }

        $similarPackages = EventPackage::with(['category', 'images'])
            ->where('category_id', $this->package->category_id)
            ->where('id', '!=', $this->packageId)
            ->where('is_active', true)
            ->take(6)
            ->get();

        return $similarPackages->map(function($package) {
            return [
                'id' => $package->id,
                'name' => $package->name,
                'price' => $package->discounted_price,
                'original_price' => $package->price,
                'description' => $package->description,
                'duration' => $package->formatted_duration,
                'category' => $package->category->name ?? 'General',
                'image' => $package->images->first()->image_url ?? 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=300&fit=crop',
                'rating' => rand(40, 50) / 10,
                'popular' => $package->is_special
            ];
        });
    }

    public function nextImage()
    {
        $totalImages = count($this->packageImages);
        $this->currentImageIndex = ($this->currentImageIndex + 1) % $totalImages;
    }

    public function previousImage()
    {
        $totalImages = count($this->packageImages);
        $this->currentImageIndex = $this->currentImageIndex === 0 
            ? $totalImages - 1 
            : $this->currentImageIndex - 1;
    }

    public function selectImage($index)
    {
        $this->currentImageIndex = $index;
    }

    public function render()
    {
        return view('livewire.public.event.package-detail');
    }
}
