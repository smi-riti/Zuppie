<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

class Show extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingId = null;

    #[On('refresh-services')]
    public function refreshServices()
    {
        $this->resetPage();
    }

    public function openCreateModal($id = null)
    {
        $this->editingId = $id;
        $this->showModal = true;
    }

    #[On('close-modal')]
    public function closeModal()
    {
        $this->showModal = false;
        $this->editingId = null;
    }

    public function deleteService($id)
    {
        $this->authorize('manage-services');
        Service::findOrFail($id)->delete();
        session()->flash('message', 'Service deleted successfully!');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $services = Service::paginate(10);
        return view('livewire.admin.service.show', compact('services'));
    }
}