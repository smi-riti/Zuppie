<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\User;
use App\Models\Service; // Import the Service model
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreateBooking extends Component
{
    public $name;
    public $email;
    public $phone_no;
    public $event_package_id;
    public $event_date;
    public $event_end_date;
    public $guest_count = 1;
    public $pin_code;
    public $location;
    public $special_requests;
    public $total_price = 0;
    public $user_id;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone_no' => 'required|digits:10',
        'event_package_id' => 'required|exists:event_packages,id',
        'event_date' => 'required|date|after_or_equal:today',
        'event_end_date' => 'required|date|after_or_equal:event_date',
        'guest_count' => 'required|integer|min:1',
        'pin_code' => 'required|digits:6',
        'location' => 'required|min:5',
    ];

    protected $messages = [
        'pin_code.service_available' => 'Service is not available for this PIN code.',
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

    public function save()
    {
        // Add custom validation for service availability
        $this->validate(array_merge($this->rules, [
            'pin_code' => [
                'required',
                'digits:6',
                function ($attribute, $value, $fail) {
                    if (!Service::where('pin_code', $value)->exists()) {
                        $fail('Service is not available for this PIN code.');
                    }
                }
            ]
        ]));

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