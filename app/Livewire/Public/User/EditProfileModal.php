<?php

namespace App\Livewire\Public\User;

use App\Models\User;
use Livewire\Component;

class EditProfileModal extends Component
{
    public $showEditProfileModal = false;
    public $userDetails;
    public $user;
    public $name, $email, $phone_no;

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone_no = $this->user->phone_no;
    }
    public function openEditProfileModal($userId)
    {
        $this->showEditProfileModal = true;
        $this->userDetails = User::findOrFail($userId);
    }

    public function closeEditProfileModal()
    {
        $this->dispatch('closeEditProfileModal');
    }

    protected $rules = [
        'name' => 'string|max:255',
        'email' => 'email|max:255',
        'phone_no' => 'string|max:20',
    ];

    public function updateProfile(){
        $this->validate();

         $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
        ]);
        $this->closeEditProfileModal();
    }

    public function render()
    {
        return view('livewire.public.user.edit-profile-modal');
    }
}
