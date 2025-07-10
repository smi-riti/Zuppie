<?php

namespace App\Livewire\Admin\EventPackage;


use App\Models\EventPackage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;


class ListPackage extends Component
{
    use WithPagination;

    public $showCreateModal = false;
    public $showUpdateModal = false;
    public $showDeleteModal = false;
    public $packageToDelete;
    public $packageIdToUpdate;

    protected $listeners = [
        'packageCreated' => '$refresh',
        'packageUpdated' => '$refresh',
        'closeCreateModal' => 'closeCreateModal',
        'closeUpdateModal' => 'closeUpdateModal',
    ];

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function openUpdateModal($packageId)
    {
        $this->packageIdToUpdate = $packageId;
        $this->showUpdateModal = true;
    }

    public function openDeleteModal($packageId)
    {
        $this->packageToDelete = $packageId;
        $this->showDeleteModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
    }

    public function closeUpdateModal()
    {
        $this->showUpdateModal = false;
    }

    public function deletePackage()
    {
        EventPackage::findOrFail($this->packageToDelete)->delete();
        $this->showDeleteModal = false;
        session()->flash('message', 'Package deleted successfully!');
    }
    #[Layout('components.layouts.admin')]

    public function render()
    {

    
        return view('livewire.admin.event-package.list-package', [
            'packages' => EventPackage::with('category')->paginate(10),
        ]);
    }
}
