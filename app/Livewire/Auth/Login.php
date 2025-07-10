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

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();
            
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