<?php

namespace App\Livewire\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
#[Title('Phone OTP Login')]

class PhoneOtpVerify extends Component
{
    public $phone_no;
    public $otp;
    public $error = '';

    public function mount($phone_no)
    {
        $this->phone_no = preg_replace('/[^0-9]/', '', $phone_no);
    }

    protected $rules = [
        'otp' => 'required|digits:6'
    ];

    public function verifyOtp()
    {
        try {
            $this->validate();
            $this->reset('error');
            
            $user = User::where('phone_no', $this->phone_no)
                        ->where('otp', $this->otp)
                        ->where('otp_expires_at', '>', now())
                        ->first();
            
            if (!$user) {
                throw new \Exception('Invalid or expired OTP');
            }
            
            Auth::login($user);
            
            $user->update([
                'otp' => null,
                'otp_expires_at' => null
            ]);
            
            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            logger()->error('OTP Verify Error: ' . $e->getMessage());
        }
    }

    public function resendOtp()
    {
        try {
            $user = User::where('phone_no', $this->phone_no)->first();
            
            if (!$user) {
                throw new \Exception('Phone number not found');
            }
            
            $otpCode = rand(100000, 999999);
            
            $user->update([
                'otp' => $otpCode,
                'otp_expires_at' => now()->addMinutes(10)
            ]);
            
            Mail::to($user->email)->send(new SendOtp($otpCode));
            
            session()->flash('status', 'New OTP has been sent.');
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }
    

    // public function render()
    // {
    // return view('livewire.auth.phone-otp-verify');
    // }
    // // BEFORE:

// AFTER:
public function render()
{
    return view('livewire.auth.phone-otp-verify');
}
}