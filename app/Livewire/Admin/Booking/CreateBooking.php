<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreateBooking extends Component
{
    public $name;
    public $email;
    public $phone_no;
    public $event_package_id;
    
    public $event_date_date;
    public $event_date_time;
    public $event_end_date_date;
    public $event_end_date_time;
    
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
        'event_date_date' => 'required|date|after_or_equal:today',
        'event_date_time' => 'required',
        'event_end_date_date' => 'required|date|after_or_equal:event_date_date',
        'event_end_date_time' => 'required',
        'guest_count' => 'required|integer|min:1',
        'pin_code' => 'required|digits:6',
        'location' => 'required|min:5',
    ];

    public function mount()
    {
        $defaultDate = now()->addDays(7);
        $this->event_date_date = $defaultDate->format('Y-m-d');
        $this->event_date_time = $defaultDate->format('g:i A'); // AM/PM format
        
        $endDate = $defaultDate->addHours(4);
        $this->event_end_date_date = $endDate->format('Y-m-d');
        $this->event_end_date_time = $endDate->format('g:i A'); // AM/PM format
    }

    public function updatedEventPackageId($value)
    {
        $this->calculateTotal();
    }

    public function updatedGuestCount($value)
    {
        $this->calculateTotal();
    }
     public function closeModal()
    {
        $this->dispatch('closeModal');
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
        // Convert AM/PM time to 24-hour format for database
        $this->prepareDateTimeForStorage();
        
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

        // Combine date and time for database storage
        $eventDate = Carbon::parse($this->event_date_date . ' ' . $this->event_date_time);
        $eventEndDate = Carbon::parse($this->event_end_date_date . ' ' . $this->event_end_date_time);

        // Create booking with both user and booking fields
        Booking::create([
            'user_id' => $user->id,
            'event_package_id' => $this->event_package_id,
            'event_date' => $eventDate,
            'event_end_date' => $eventEndDate,
            'guest_count' => $this->guest_count,
            'pin_code' => $this->pin_code,
            'location' => $this->location,
            'special_requests' => $this->special_requests,
            'total_price' => $this->total_price,
            'status' => 'confirmed',
            'booking_name' => $this->name,
            'booking_email' => $this->email,
            'booking_phone_no' => $this->phone_no,
        ]);

        session()->flash('message', 'Booking created successfully!');
        $this->dispatch('bookingCreated');
    }
    
    protected function prepareDateTimeForStorage()
    {
        // Convert AM/PM time to 24-hour format for validation
        $this->event_date_time = Carbon::parse($this->event_date_time)->format('H:i');
        $this->event_end_date_time = Carbon::parse($this->event_end_date_time)->format('H:i');
    }

    public function render()
    {
        return view('livewire.admin.booking.create-booking', [
            'packages' => EventPackage::all(),
        ]);
    }
}