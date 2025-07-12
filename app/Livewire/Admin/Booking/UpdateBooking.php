<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class UpdateBooking extends Component
{
    public $bookingId;
    public $name;
    public $email;
    public $phone_no;
    public $event_package_id;
    public $booking_date;
    public $event_date;
    public $event_end_date;
    public $guest_count;
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
        'event_date' => 'required|date',
        'event_end_date' => 'required|date|after:event_date',
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
        $this->booking_date = $booking->booking_date->format('Y-m-d\TH:i');
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
    public function updatedPinCode($value)
    {
        // Only fetch location if PIN code is 6 digits
        if (strlen($value) === 6) {
            $this->is_fetching_location = true;
            
            try {
                // Make API request to get location details
                $response = Http::get("https://api.postalpincode.in/pincode/{$value}");
                
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

    public function update()
    {
        $this->validate();

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
            'booking_date' => $this->booking_date,
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