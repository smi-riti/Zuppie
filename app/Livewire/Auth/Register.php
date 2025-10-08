<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\User;
#[Title('Register')]

#[Layout("components.layouts.app")]
class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $phone_no = '';
    public $message = '';

    public function mount()
    {
        // Pre-fill form if coming from booking
        $bookingData = session('booking_step3_data');
        if ($bookingData) {
            $this->name = $bookingData['name'] ?? '';
            $this->email = $bookingData['email'] ?? '';
            $this->phone_no = $bookingData['phone'] ?? '';
        }
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:8|same:password_confirmation',
        'phone_no' => 'required|string|max:20|unique:users',
    ];

    protected $messages = [
        'name.required' => 'Name is required',
        'email.required' => 'Email address is required',
        'email.email' => 'Please enter a valid email address',
        'email.unique' => 'This email address is already registered',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 8 characters',
        'password.same' => 'Password confirmation does not match',
        'phone_no.required' => 'Phone number is required',
        'phone_no.unique' => 'This phone number is already registered',
    ];

    public function register()
    {
        $this->validate();

        Log::info('Register request: ' . json_encode([
            'name' => $this->name,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
        ]));

        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'phone_no' => $this->phone_no,
            ]);

            auth()->login($user);

            // Check if coming from booking flow
            $bookingData = session('booking_form_data');
            $packageId = session('booking_package_id');
            $pinCode = session('booking_pin_code');
            
            if ($bookingData && $packageId && $pinCode) {
                session()->flash('success', 'Registration successful! Continue with your booking.');
                return redirect()->route('package-booking', [
                    'package_id' => $packageId,
                    'pin_code' => $pinCode
                ]);
            }

            if ($user->is_admin) {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/');
            }
        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            $this->message = 'Registration failed: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}