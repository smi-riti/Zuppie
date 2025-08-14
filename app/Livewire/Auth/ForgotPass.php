<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;
#[Title('Forgot Password')]
class ForgotPass extends Component
{
    public $email;
    public $emailSent = false;
    public $error = null;

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email'
        ];
    }

    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            $this->emailSent = true;
            $this->error = null;
        } else {
            $this->error = __($status);
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-pass');
    }
}
