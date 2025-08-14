<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\User;
#[Title('Manage Users')]

class ManageUser extends Component
{
    use WithPagination;
    public $search = '';
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $users = User::when($this->search, function ($query) {
                return $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('phone_no', 'like', '%'.$this->search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('livewire.admin.user.manage-user', [
            'users' => $users
        ]);
    }
}
