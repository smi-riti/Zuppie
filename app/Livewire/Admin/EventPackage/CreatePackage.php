<?php

namespace App\Livewire\Admin\EventPackage;
use App\Models\EventPackage;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use App\Helpers\ImageKitHelper;
use Livewire\Attributes\Layout;
#[Title('Create Package')]

class CreatePackage extends Component
{
    use WithFileUploads;
    public $category_id, $name, $price, $discount_type, $discount_value, $description, $features, $is_active = true, $is_special = false;
    public $duration_hours = 0;
    public $duration_minutes = 0;
    public $categories = [];
    public $newImages = [];

    protected function rules()
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:percentage,fixed',
            'discount_value' => 'nullable|numeric|min:0|required_if:discount_type,percentage,fixed',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'newImages.*' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'is_special' => 'boolean',
            'duration_hours' => 'nullable|integer|min:0',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
        ];
    }
    
    protected function messages()
    {
        return [
            'newImages.*.image' => 'Each upload must be a valid image file.',
            'newImages.*.max' => 'Each image must not exceed 2MB in size.',
            'duration_minutes.max' => 'Minutes cannot exceed 59.',
        ];
    }

    public function mount()
    {
        $this->categories = Category::all();
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

        $durationInMilliseconds = null;
        if ($this->duration_hours > 0 || $this->duration_minutes > 0) {
            $durationInMilliseconds = ((int)$this->duration_hours * 60 + (int)$this->duration_minutes) * 60 * 1000;
        }

        $package = EventPackage::create([
            'category_id' => $this->category_id ?: null,
            'name' => $this->name,
            'price' => $this->price,
            'discount_type' => $this->discount_type ?: null,
            'discount_value' => $this->discount_type ? $this->discount_value : null,
            'description' => $this->description,
            'features' => $this->features,
            'is_active' => $this->is_active,
            'is_special' => $this->is_special,
            'duration' => $durationInMilliseconds,
        ]);

        if ($this->newImages) {
            foreach ($this->newImages as $image) {
                if ($image) {
                    $upload = ImageKitHelper::uploadImage($image, '/Zuppie/PackageImages');
                    if ($upload) {
                        $package->images()->create([
                            'image_url' => $upload['url'],
                            'image_file_id' => $upload['fileId'],
                        ]);
                    }
                }
            }
        }
        $this->reset();
        session()->flash('message', 'Package created successfully!');
        return redirect()->route('admin.event-packages');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.event-package.create-package', [
            'categories' => $this->categories,
        ]);
    }
}