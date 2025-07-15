<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;

class Create extends Component
{
    public $pin_code;
    public $editingId;

    protected function rules()
    {
        return [
            'pin_code' => 'required|digits:6|unique:services,pin_code' . ($this->editingId ? ',' . $this->editingId : ''),
        ];
    }

    protected $messages = [
        'pin_code.required' => 'The pin code is required.',
        'pin_code.digits' => 'The pin code must be exactly 6 digits.',
        'pin_code.unique' => 'This pin code already exists.',
    ];

    public function mount($editingId = null)
    {
        $this->editingId = $editingId;
        if ($editingId) {
            $service = Service::find($editingId);
            if (!$service) {
                session()->flash('error', 'Service not found.');
                $this->dispatch('close-modal');
                return;
            }
            $this->pin_code = $service->pin_code;
        }
    }

    public function saveService()
    {
        $this->authorize('manage-services');
        $this->validate();
        $data = ['pin_code' => $this->pin_code];

        if ($this->editingId) {
            Service::findOrFail($this->editingId)->update($data);
            $message = 'Service updated successfully!';
        } else {
            Service::create($data);
            $message = 'Service created successfully!';
        }

        $this->dispatch('refresh-services');
        $this->dispatch('close-modal');
        session()->flash('message', $message);
    }

    public function render()
    {
        return view('livewire.admin.service.create');
    }
}