<?php

namespace App\Livewire\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtp;
use Illuminate\Support\Facades\Log;
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
            // log attempt for debugging
            Log::info('OTP verify attempt', ['phone' => $this->phone_no, 'entered_otp' => $this->otp]);

                // fetch user record for diagnostics
                $dbUser = User::where('phone_no', $this->phone_no)->first();
                if ($dbUser) {
                    Log::info('Stored OTP for phone', [
                        'phone' => $this->phone_no,
                        'stored_otp' => $dbUser->otp,
                        'expires_at' => $dbUser->otp_expires_at
                    ]);
                } else {
                    Log::warning('No user found while verifying OTP', ['phone' => $this->phone_no]);
                }

                $user = User::where('phone_no', $this->phone_no)
                            ->where('otp', $this->otp)
                            ->where('otp_expires_at', '>', now())
                            ->first();
            
            if (!$user) {
                Log::warning('OTP verification failed', [
                    'phone' => $this->phone_no,
                    'entered_otp' => $this->otp
                ]);
                throw new \Exception('Invalid or expired OTP');
            }
            
            Auth::login($user);

            Log::info('OTP verification succeeded, user logged in', ['user_id' => $user->id, 'phone' => $user->phone_no]);

            $user->update([
                'otp' => null,
                'otp_expires_at' => null
            ]);

            return redirect()->route('home');
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
                Log::info('OTP resent', [
                'phone' => $this->phone_no,
                'otp' => $otpCode,
                'expires_at' => $user->otp_expires_at
            ]);
            
            session()->flash('status', 'New OTP has been sent.');
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }
    

public function render()
{
    return view('livewire.auth.phone-otp-verify');
}
}
