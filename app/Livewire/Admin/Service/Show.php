<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
 #[Layout('components.layouts.admin')]
class Show extends Component
{
    use WithPagination;
    
    public $editingId = null;
    public $pin_code = '';
    public $search = '';
    public $formTitle = 'Create New Service';

    protected $rules = [
        'pin_code' => 'required|string|max:10|unique:services,pin_code',
    ];

    protected $messages = [
        'pin_code.required' => 'The pin code is required.',
        'pin_code.unique' => 'This pin code already exists.',
    ];

    public function mount()
    {
        $this->resetValidation();
    }

    public function editService($id)
    {
        $this->editingId = $id;
        $service = Service::findOrFail($id);
        $this->pin_code = $service->pin_code;
        $this->formTitle = 'Edit Service';
        $this->rules['pin_code'] = 'required|string|max:10|unique:services,pin_code,' . $id;
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->pin_code = '';
        $this->formTitle = 'Create New Service';
        $this->resetValidation();
        $this->rules['pin_code'] = 'required|string|max:10|unique:services,pin_code';
    }

    public function saveService()
    {
        $this->validate();

        if ($this->editingId) {
            Service::find($this->editingId)->update(['pin_code' => $this->pin_code]);
            $message = 'Service updated successfully!';
        } else {
            Service::create(['pin_code' => $this->pin_code]);
            $message = 'Service created successfully!';
        }

        $this->resetForm();
        session()->flash('message', $message);
        $this->resetPage();
    }

    public function deleteService($id)
    {
        Service::find($id)->delete();
        if ($this->editingId == $id) {
            $this->resetForm();
        }
        session()->flash('message', 'Service deleted successfully!');
        $this->resetPage();
    }
   
    public function render()
    {
        $services = Service::when($this->search, function ($query) {
                $query->where('pin_code', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('livewire.admin.service.show', compact('services'));
    } 
}