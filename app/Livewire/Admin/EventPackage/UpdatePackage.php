<?php

namespace App\Livewire\Admin\EventPackage;

use Livewire\Component;
use App\Models\EventPackage;
use App\Models\Category;    
class UpdatePackage extends Component
{ 
    public $packageId, $category_id, $name, $price, $discount_type, $discount_value, $description, $images = [], $is_active, $is_special, $duration;
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

    public function mount($packageId)
    {
        $package = EventPackage::findOrFail($packageId);
        $this->packageId = $package->id;
        $this->category_id = $package->category_id;
        $this->name = $package->name;
        $this->price = $package->price;
        $this->discount_type = $package->discount_type;
        $this->discount_value = $package->discount_value;
        $this->description = $package->description;
        $this->images = $package->images ?? [];
        $this->is_active = $package->is_active;
        $this->is_special = $package->is_special;
        $this->duration = $package->duration;
        $this->categories = Category::all()->pluck('name', 'id')->toArray();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'discount_type' && empty($this->discount_type)) {
            $this->discount_value = null;
        }
    }

    public function update()
    {
        $this->validate();

        $package = EventPackage::findOrFail($this->packageId);
        $package->update([
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

        $this->dispatch('packageUpdated');
        $this->dispatch('closeUpdateModal');
        session()->flash('message', 'Package updated successfully!');
    }


    public function render()
    {
        return view('livewire.admin.event-package.update-package', [
            'categories' => $this->categories,
        ]);
    }
}
