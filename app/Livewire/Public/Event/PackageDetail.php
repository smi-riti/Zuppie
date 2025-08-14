<?php

namespace App\Livewire\Public\Event;

use App\Models\reviews;
use Livewire\Attributes\On;
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
    public $pinCodeStatus = null; // null, 'checking', 'available', 'unavailable', 'error'
    public $pinCodeMessage = '';

    public $average_review = 0;
    public $totalReview;
    public $reviewImages;
    public $showModal = false;
    public $packageIdToViewReviews;


    #[On('viewAllReviews')]
    public function openModal($packageId){
        $this->showModal = true;
    }
    public function closeModal(){
        $this->showModal = false;
    }

    protected $rules = [
        'pinCode' => 'required|numeric|digits:6',
    ];

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
        $this->package = EventPackage::with(['category', 'images'])
            ->where(function ($query) {
                $query->where('slug', $this->packageId)
                    ->orWhere('id', $this->packageId);
            })
            ->where('is_active', true)
            ->firstOrFail();

        $this->countAvgReview();
    }
    public function updatedPinCode($value)
    {
        $this->resetPinCodeStatus();

        if (strlen($value) === 6) {
            $this->checkPinCodeAvailability();
        }
    }
    public function resetPinCodeStatus()
    {
        $this->pinCodeStatus = null;
        $this->pinCodeMessage = '';
        $this->isPinCodeAvailable = null;
    }
    public function checkPinCodeAvailability()
    {
        $this->validateOnly('pinCode');
        $this->pinCodeStatus = 'checking';
        $this->pinCodeMessage = 'Checking pincode availability...';
        $this->checkingPinCode = true;

        try {
            $service = Service::where('pin_code', $this->pinCode)->first();
            $this->isPinCodeAvailable = (bool) $service;

            if ($this->isPinCodeAvailable) {
                $this->pinCodeStatus = 'available';
                $this->pinCodeMessage = 'Great! We provide services in your area.';
                session(['pin_code' => $this->pinCode]);
            } else {
                $this->pinCodeStatus = 'unavailable';
                $this->pinCodeMessage = 'Sorry, we don\'t provide services in this area yet.';
            }
        } catch (\Exception $e) {
            $this->pinCodeStatus = 'error';
            $this->pinCodeMessage = 'Error checking pincode availability';
            $this->isPinCodeAvailable = false;
        } finally {
            $this->checkingPinCode = false;
        }
    }
    public function countAvgReview()
    {
        $totalRating = reviews::where('event_package_id', $this->package->id)->sum('rating');
        $reviewCount = reviews::where('event_package_id', $this->package->id)->count();

        $this->totalReview = $reviewCount;
        $this->average_review = $reviewCount > 0 ? round($totalRating / $reviewCount, 2) : 0;
    }
    public function bookNow()
    {
        if (!$this->isPinCodeAvailable) {
            $this->pinCodeStatus = 'error';
            $this->pinCodeMessage = 'Please check pincode availability first.';
            return;
        }

        session([
            'package_id' => $this->packageId,
            'pin_code' => $this->pinCode,
            'pin_code_checked' => true
        ]);

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

        return empty($images) ? [
            'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
        ] : $images;
    }
    public function getPackageFeaturesProperty()
    {
        return $this->package->features ?? [
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

        return EventPackage::with(['category', 'images'])
            ->where('category_id', $this->package->category_id)
            ->where('id', '!=', $this->packageId)
            ->where('is_active', true)
            ->take(6)
            ->get()
            ->map(function ($package) {
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
        $this->currentImageIndex = ($this->currentImageIndex + 1) % count($this->packageImages);
    }
    public function previousImage()
    {
        $this->currentImageIndex = $this->currentImageIndex === 0
            ? count($this->packageImages) - 1
            : $this->currentImageIndex - 1;
    }
    public function selectImage($index)
    {
        $this->currentImageIndex = $index;
    }
    public function render()
    {
        $reviews = reviews::where('event_package_id', $this->package->id)
        ->where('approved', true)
        ->where('rating', '>=', 3)
            ->limit(3)->get();
        $this->countAvgReview();
        return view('livewire.public.event.package-detail', compact('reviews'));
    }
}