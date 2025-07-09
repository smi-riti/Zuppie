<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\User;

#[Layout("components.layouts.app")]
class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $phone_no = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:8|same:password_confirmation',
        'phone_no' => 'required|string|max:20',
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