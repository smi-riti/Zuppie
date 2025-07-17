<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

#[Layout("components.layouts.app")]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $message = '';

    public function mount()
    {
        // Pre-fill email if coming from booking
        $bookingData = session('booking_step3_data');
        if ($bookingData && $bookingData['email']) {
            $this->email = $bookingData['email'];
        }
    }

    protected $rules = [
        'email' => 'required|email|max:255',
        'password' => 'required|min:8',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();
            
            // Check if coming from booking flow
            $bookingData = session('booking_form_data');
            if ($bookingData) {
                session()->flash('success', 'Login successful! Continue with your booking.');
                return redirect()->route('package-booking', ['package_id' => $bookingData['packageId']]);
            }
            
            // Check if user is admin
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('home');
        }

        $this->message = 'Invalid email or password.';
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}