<?php

namespace App\Livewire\Admin\EventPackage;
use App\Models\EventPackage;
use Livewire\Component;
use App\Models\Category;


class CreatePackage extends Component
{
    public $category_id, $name, $price, $discount_type, $discount_value, $description, $images = [], $is_active = true, $is_special = false, $duration;
    public $categories = [];

    protected function rules()
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:percentage,fixed',
            'discount_value' => 'nullable|numeric|min:0|required_if:discount_type,percentage,fixed',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'is_active' => 'boolean',
            'is_special' => 'boolean',
            'duration' => 'nullable|integer|min:1',
        ];
    }

    public function mount()
    {
        $this->categories = Category::all()->pluck('name', 'id')->toArray();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'discount_type' && empty($this->discount_type)) {
            $this->discount_value = null;
        }
    }

    public function submit()
    {
        $this->validate();

        EventPackage::create([
            'category_id' => $this->category_id ?: null,
            'name' => $this->name,
            'price' => $this->price,
            'discount_type' => $this->discount_type ?: null,
            'discount_value' => $this->discount_type ? $this->discount_value : null,
            'description' => $this->description,
            'images' => $this->images,
            'is_active' => $this->is_active,
            'is_special' => $this->is_special,
            'duration' => $this->duration,
        ]);

        $this->reset();
        $this->dispatch('packageCreated');
        $this->dispatch('closeCreateModal');
        session()->flash('message', 'Package created successfully!');
    }

    public function render()
    {
        return view('livewire.admin.event-package.create-package', [
            'categories' => $this->categories,
        ]);
    }
}
