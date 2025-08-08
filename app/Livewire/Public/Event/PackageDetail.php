<?php

namespace App\Livewire\Public\Event;

use App\Models\reviews;
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

    public $average_review = 0;
    public $totalReview;
    public $reviewImages;
    public function countAvgReview()
    {
        $totalRating = reviews::where('event_package_id', $this->packageId)->sum('rating');
        $reviewCount = reviews::where('event_package_id', $this->packageId)->count();
        $this->totalReview = $reviewCount;
        $this->average_review = $reviewCount > 0
            ? round($totalRating / $reviewCount, 2)
            : 0; // Default when no reviews
    }
    public function mount($slug = null)
    {
        $this->packageId = $slug;
        $this->loadPackage();

        // Initialize pin code from session if available
        if (session()->has('pin_code')) {
            $this->pinCode = session('pin_code');
            $this->checkPinCodeAvailability();
        }
    }
    public function loadPackage()
    {
        // Try to find by slug first, then by ID for backward compatibility
        $this->package = EventPackage::with(['category', 'images'])
            ->where(function ($query) {
                $query->where('slug', $this->packageId)
                    ->orWhere('id', $this->packageId);
            })
            ->where('is_active', true)
            ->first();

        if (!$this->package) {
            session()->flash('error', 'Package not found or no longer available.');
            return redirect()->route('event-packages');
        }

        $this->countAvgReview();
    }

    public function checkPinCodeAvailability()
    {
        $this->validate([
            'pinCode' => 'required|numeric|digits:6'
        ]);

        $this->checkingPinCode = true;
        $this->resetErrorBag(); // Clear previous errors

        try {
            // Check if pin code exists in service model
            $service = Service::where('pin_code', $this->pinCode)->first();
            $this->isPinCodeAvailable = $service ? true : false;

            if ($this->isPinCodeAvailable) {
                session()->flash('pin_message', 'Great! We provide services in your area.');
            } else {
                session()->flash('pin_error', 'Sorry, we don\'t provide services in this area yet.');
            }
        } catch (\Exception $e) {
            session()->flash('pin_error', 'Error checking pin code availability');
        } finally {
            $this->checkingPinCode = false;
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
        if (!$this->package)
            return [];

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

        return $similarPackages->map(function ($package) {
            return [
                'id' => $package->id,
                'slug' => $package->slug,
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
        $reviews = reviews::all();
        $this->countAvgReview();
        return view('livewire.public.event.package-detail', compact('reviews'));
    }
}
