<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Mail\LoginNotificationMail;
use Illuminate\Support\Facades\Mail;

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
            
            // Send login notification email
            // Mail::to($user->email)->send(new LoginNotificationMail($user));
            
            // Check if coming from booking flow
            $bookingData = session('booking_form_data');
            $packageId = session('booking_package_id');
            $pinCode = session('booking_pin_code');
            
            if ($bookingData && $packageId && $pinCode) {
                session()->flash('success', 'Login successful! Continue with your booking.');
                return redirect()->route('package-booking', [
                    'package_id' => $packageId,
                    'pin_code' => $pinCode
                ]);
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