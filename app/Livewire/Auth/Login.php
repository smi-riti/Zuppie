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

    protected $rules = [
        'email' => 'required|email|max:255',
        'password' => 'required|min:8',
    ];

    public function login()
    {
        $this->validate();

        Log::info('Login attempt: ' . json_encode([
            'email' => $this->email,
        ]));

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            if ($user->is_admin) {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/home');
            }
        } else {
            $this->message = 'Invalid email or password.';
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}