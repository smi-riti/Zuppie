<?php
namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\User;
use App\Models\Service;
use Illuminate\Validation\ValidationException;

class UpdateBooking extends Component
{
    public $bookingId;
    public $name;
    public $email;
    public $phone_no;
    public $event_package_id;
    public $event_date;
    public $event_end_date;
    public $guest_count;
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

    public function mount($bookingId)
    {
        $this->bookingId = $bookingId;
        $booking = Booking::with('user', 'eventPackage')->findOrFail($bookingId);
        
        $this->name = $booking->user->name;
        $this->email = $booking->user->email;
        $this->phone_no = $booking->user->phone_no;
        $this->event_package_id = $booking->event_package_id;
        $this->event_date = $booking->event_date->format('Y-m-d\TH:i');
        $this->event_end_date = $booking->event_end_date->format('Y-m-d\TH:i');
        $this->guest_count = $booking->guest_count;
        $this->pin_code = $booking->pin_code;
        $this->location = $booking->location;
        $this->special_requests = $booking->special_requests;
        $this->total_price = $booking->total_price;
        $this->user_id = $booking->user_id;
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

    public function update()
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

        // Update user
        $user = User::findOrFail($this->user_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
        ]);

        // Update booking
        $booking = Booking::findOrFail($this->bookingId);
        $booking->update([
            'event_package_id' => $this->event_package_id,
            'event_date' => $this->event_date,
            'event_end_date' => $this->event_end_date,
            'guest_count' => $this->guest_count,
            'pin_code' => $this->pin_code,
            'location' => $this->location,
            'special_requests' => $this->special_requests,
            'total_price' => $this->total_price,
        ]);

        session()->flash('message', 'Booking updated successfully!');
        $this->dispatch('bookingUpdated');
    }

    public function render()
    {
        return view('livewire.admin.booking.update-booking', [
            'packages' => EventPackage::all(),
        ]);
    }
}