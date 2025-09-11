<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtp;
use Illuminate\Support\Facades\Log;
#[Title('Phone OTP Login')]

class PhoneOtpLogin extends Component
{
    public $phone_no;
    public $sent = false;
    public $message = '';
    public $error = '';

    protected $rules = [
        'phone_no' => 'required|numeric|digits_between:8,15'
    ];

    public function sendOtp()
    {
        try {
            $this->phone_no = preg_replace('/[^0-9]/', '', $this->phone_no);
            
            $this->validate();
            $this->reset('error');
            
            $user = User::where('phone_no', $this->phone_no)->first();
            
            if (!$user) {
                throw new \Exception('The phone number is not registered.');
            }
            
            $otpCode = rand(100000, 999999);
            
            $user->update([
                'otp' => $otpCode,
                // set to 3 minutes as requested
                'otp_expires_at' => now()->addMinutes(3)
            ]);
            
            Mail::to($user->email)->send(new SendOtp($otpCode));

            Log::info('OTP generated', [
                'phone' => $this->phone_no,
                'otp' => $otpCode,
                'expires_at' => $user->otp_expires_at ?? now()->addMinutes(3)
            ]);
            
            $this->sent = true;
            $this->message = 'OTP sent to your registered email!';
            // redirect to the verify route - use the correct route name and param
            return redirect()->route('phone.otp.verify', ['phone_no' => $this->phone_no]);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            logger()->error('OTP Send Error: ' . $e->getMessage());
        }
    }

    public function resendOtp()
    {
        $this->sendOtp();
        $this->message = $this->message ?: 'New OTP sent!';
    }
    public function render()
    {
        return view('livewire.auth.phone-otp-login');
    }
}