<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\User;
use App\Models\Booking;
use App\Models\Category;
use App\Models\EventPackage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Bookingform extends Component
{
  public $name;
    public $email;
    public $phone_no;
    public $event_package_id;
    public $event_date;
    public $event_end_date;
    public $guest_count = 1;
    public $location;
    public $special_requests;
    public $total_price = 0;
    public $pin_code;
    public $packages = [];
    public $selected_package_price = 0;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone_no' => 'required|digits:10',
        'event_package_id' => 'required|exists:event_packages,id',
        'event_date' => 'required|date|after_or_equal:today',
        'event_end_date' => 'nullable|date|after_or_equal:event_date',
        'pin_code' => 'required|string|size:6',
        'guest_count' => 'required|integer|min:1',
        'location' => 'required|string|max:255',
        'special_requests' => 'nullable|string',
    ];

    public function mount()
    {
        $this->packages = EventPackage::all();
    }

    public function updatedEventPackageId($value)
    {
        if ($value) {
            $package = EventPackage::find($value);
            $this->selected_package_price = $package->price ?? 0;
            $this->calculateTotalPrice();
        } else {
            $this->selected_package_price = 0;
            $this->total_price = 0;
        }
    }

    public function updatedGuestCount()
    {
        $this->calculateTotalPrice();
    }

    public function updatedPinCode($value)
    {
        if (strlen($value) === 6) {
            try {
                $response = \Illuminate\Support\Facades\Http::get("https://api.postalpincode.in/pincode/{$value}")->json();
                
                if (isset($response[0]['Status']) && $response[0]['Status'] === 'Success' && !empty($response[0]['PostOffice'])) {
                    $location = "{$response[0]['PostOffice'][0]['Name']}, {$response[0]['PostOffice'][0]['District']}, {$response[0]['PostOffice'][0]['State']}";
                    // Update location using Livewire's data binding
                    $this->location = $location;
                    
                    // Clear any previous errors
                    $this->resetErrorBag('pin_code');
                    $this->resetErrorBag('location');
                    
                    // Validate the location field
                    $this->validateOnly('location');
                } else {
                    $this->location = '';
                    $this->addError('pin_code', 'Invalid PIN code or no location found.');
                }
            } catch (\Exception $e) {
                $this->location = '';
                $this->addError('pin_code', 'Error fetching location: ' . $e->getMessage());
            }
        } else {
            $this->location = '';
        }
    }

    protected function calculateTotalPrice()
    {
        $this->total_price = $this->selected_package_price * $this->guest_count;
    }

    public function updatedPhoneNo($value)
    {
        if (User::where('phone_no', $value)->exists()) {
            $this->addError('phone_no', 'You already have an account with this phone number. Please login.');
        }
    }

    public function submit()
    {
        $this->validate();

        if (User::where('phone_no', $this->phone_no)->exists()) {
            throw ValidationException::withMessages([
                'phone_no' => ['You already have an account with this phone number. Please login.'],
            ]);
        }

        try {
            // Create user
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone_no' => $this->phone_no,
                'password' => Hash::make(Str::random(8)),
                'is_admin' => false,
            ]);

            // Create booking
            Booking::create([
                'user_id' => $user->id,
                'event_package_id' => $this->event_package_id,
                'event_date' => $this->event_date,
                'event_end_date' => $this->event_end_date,
                'guest_count' => $this->guest_count,
                'pin_code' => $this->pin_code,
                'location' => $this->location,
                'special_requests' => $this->special_requests,
                'status' => 'pending',
                'total_price' => $this->total_price,
            ]);

            session()->flash('message', 'Booking created successfully!');
            $this->resetExcept(['packages']);
            $this->packages = EventPackage::all();
        } catch (\Exception $e) {
            session()->flash('error', 'Error creating booking: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.public.bookingform');
    }
}

