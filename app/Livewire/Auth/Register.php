<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Http\Controllers\Auth\RegistrationController;
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

        $controller = new RegistrationController();
        $request = new \Illuminate\Http\Request([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'phone_no' => $this->phone_no,
        ]);
        $response = $controller->register($request);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getContent(), true);
            $user = User::where('email', $this->email)->first();
            if ($user) {
                auth()->login($user);

                if ($user->is_admin) {
                    return redirect()->to('/admin/dashboard');
                } else {
                    return redirect()->to('/home');
                }
            } else {
                $this->message = 'User not found after registration.';
            }
        } else {
            $this->message = 'Registration failed: ' . json_decode($response->getContent(), true)['message'] ?? 'Unknown error';
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}