<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use Illuminate\Validation\ValidationException;


class CreateBooking extends Component
{
    public $name;
    public $email;
    public $phone_no;
    public $event_package_id;
    public $booking_date;
    public $event_date;
    public $event_end_date;
    public $guest_count = 1;
    public $pin_code;
    public $location;
    public $special_requests;
    public $total_price = 0;
    public $user_id;
    public $is_fetching_location = false;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone_no' => 'required|digits:10',
        'event_package_id' => 'required|exists:event_packages,id',
        'booking_date' => 'required|date',
        'event_date' => 'required|date|after:today',
        'event_end_date' => 'required|date|after:event_date',
        'guest_count' => 'required|integer|min:1',
        'pin_code' => 'required|digits:6',
        'location' => 'required|min:5',
    ];

    public function mount()
    {
        $this->booking_date = now()->format('Y-m-d\TH:i');
        $this->event_date = now()->addDays(7)->format('Y-m-d\TH:i');
        $this->event_end_date = now()->addDays(7)->addHours(4)->format('Y-m-d\TH:i');
    }

    public function updatedEventPackageId($value)
    {
        $this->calculateTotal();
    }

    public function updatedGuestCount($value)
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        if ($this->event_package_id) {
            $package = EventPackage::find($this->event_package_id);
            if ($package) {
                $this->total_price = $package->price * $this->guest_count;
            }
        }
    }

   public function updated($propertyName)
    {
        // Automatically call the location API when pin_code is updated
        if ($propertyName === 'pin_code') {
            $this->fetchLocationFromPinCode();
        }
    }

    private function fetchLocationFromPinCode()
    {
        $pinCode = $this->pin_code;
        
        // Only fetch location if PIN code is 6 digits
        if (strlen($pinCode) === 6) {
            $this->is_fetching_location = true;
            
            try {
                // Make API request to get location details
                $response = Http::get("https://api.postalpincode.in/pincode/{$pinCode}");
                
                if ($response->successful()) {
                    $data = $response->json();
                    
                    if (isset($data[0]['Status']) && $data[0]['Status'] === 'Success' && 
                        !empty($data[0]['PostOffice'])) {
                        // Extract location details
                        $postOffice = $data[0]['PostOffice'][0];
                        $this->location = "{$postOffice['Name']}, {$postOffice['District']}, {$postOffice['State']}";
                        
                        // Clear any previous errors
                        $this->resetErrorBag('pin_code');
                        $this->resetErrorBag('location');
                    } else {
                        $this->addError('pin_code', 'Invalid PIN code or no location found');
                    }
                } else {
                    $this->addError('pin_code', 'Failed to fetch location details');
                }
            } catch (\Exception $e) {
                $this->addError('pin_code', 'Error fetching location: ' . $e->getMessage());
            } finally {
                $this->is_fetching_location = false;
            }
        } else {
            $this->location = '';
        }
    }

    public function save()
    {
        $this->validate();

        // Create new user or get existing
        $user = User::firstOrCreate(
            ['email' => $this->email],
            [
                'name' => $this->name,
                'phone_no' => $this->phone_no,
                'password' => bcrypt(Str::random(10)),
            ]
        );

        // Create booking
        Booking::create([
            'user_id' => $user->id,
            'event_package_id' => $this->event_package_id,
            'booking_date' => $this->booking_date,
            'event_date' => $this->event_date,
            'event_end_date' => $this->event_end_date,
            'guest_count' => $this->guest_count,
            'pin_code' => $this->pin_code,
            'location' => $this->location,
            'special_requests' => $this->special_requests,
            'total_price' => $this->total_price,
            'status' => 'confirmed',
        ]);

        session()->flash('message', 'Booking created successfully!');
        $this->dispatch('bookingCreated');
    }


    public function render()
    {
        return view('livewire.admin.booking.create-booking', [
            'packages' => EventPackage::all(),
        ]);
    }
}