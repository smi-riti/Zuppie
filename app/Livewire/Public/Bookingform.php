<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\User;
use App\Models\Booking;
use App\Models\Category;
use App\Models\EventPackage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class Bookingform extends Component
{
    public $name;
    public $email;
    public $phone_no;
    public $event_package_id;
    public $booking_date;
    public $event_date;
    public $event_end_date;
    public $guest_count = 1;
    public $location;
    public $special_requests;
    public $total_price = 0;

    public $categories;
    public $packages = [];
    public $selected_package_price = 0;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone_no' => 'required|digits:10|unique:users,phone_no',
        'event_package_id' => 'required|exists:event_packages,id',
        'booking_date' => 'required|date',
        'event_date' => 'required|date|after_or_equal:booking_date',
        'event_end_date' => 'nullable|date|after_or_equal:event_date',
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

    protected function calculateTotalPrice()
    {
        $this->total_price = $this->selected_package_price * $this->guest_count;
    }

    public function submit()
    {
        $this->validate();

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
                'booking_date' => $this->booking_date,
                'event_date' => $this->event_date,
                'event_end_date' => $this->event_end_date,
                'guest_count' => $this->guest_count,
                'location' => $this->location,
                'special_requests' => $this->special_requests,
                'status' => 'pending',
                'total_price' => $this->total_price,
            ]);
             session()->flash('message', 'Booking created successfully!');
            $this->resetExcept(['categories']);
            $this->packages = collect();

        } catch (\Exception $e) {
            session()->flash('error', 'Error creating booking: '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.public.bookingform');
    }
}
