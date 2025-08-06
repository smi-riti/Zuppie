<?php

namespace App\Livewire\Admin\EventPackage;

use Livewire\Component;
use App\Models\EventPackage;
use App\Models\Category;   
use Livewire\WithFileUploads; 
use App\Helpers\ImageKitHelper;
use Livewire\Attributes\Layout;

class UpdatePackage extends Component
{ 
  
    use WithFileUploads;

    public $packageId, $category_id, $name, $price, $discount_type, $discount_value, $description, $features, $is_active, $is_special;
    public $categories = [];
    public $newImages = [];
    public $packageImages = [];
    public $showDeleteImageModal = false;
    public $imageToDelete = null;
    public $duration_hours = 0;
    public $duration_minutes = 0;

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
            'newImages.*' => 'nullable|file|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
            'is_active' => 'boolean',
            'is_special' => 'boolean',
            'duration_hours' => 'nullable|integer|min:0',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
        ];
    }
    
    protected function messages()
    {
        return [
            'newImages.*.file' => 'Each upload must be a valid file.',
            'newImages.*.mimes' => 'Only image files are allowed (jpg, jpeg, png, bmp, gif, svg, or webp).',
            'newImages.*.max' => 'Each image must not exceed 2MB in size.',
            'duration_minutes.max' => 'Minutes cannot exceed 59.',
        ];
    }

    public function mount($packageId)
    {
        $package = EventPackage::with('images')->findOrFail($packageId);
        $this->packageId = $package->id;
        $this->category_id = $package->category_id;
        $this->name = $package->name;
        $this->price = $package->price;
        $this->discount_type = $package->discount_type;
        $this->discount_value = $package->discount_value;
        $this->description = $package->description;
        $this->features = $package->features;
        $this->packageImages = $package->images ? $package->images->toArray() : [];
        $this->is_active = $package->is_active;
        $this->is_special = $package->is_special;
        
        if ($package->duration) {
            $totalMinutes = floor($package->duration / (1000 * 60));
            $this->duration_hours = floor($totalMinutes / 60);
            $this->duration_minutes = $totalMinutes % 60;
        } else {
            $this->duration_hours = 0;
            $this->duration_minutes = 0;
        }
        
        $this->categories = Category::all();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'discount_type' && empty($this->discount_type)) {
            $this->discount_value = null;
        }
    }

    public function confirmDeleteImage($imageId)
    {
        $this->imageToDelete = $imageId;
        $this->showDeleteImageModal = true;
    }

    public function removeImage()
    {
        if ($this->imageToDelete) {
            $image = \App\Models\EventPackageImage::find($this->imageToDelete);
            if ($image) {
                if ($image->image_file_id) {
                    ImageKitHelper::deleteImage($image->image_file_id);
                }
                $image->delete();

                $package = EventPackage::with('images')->find($this->packageId);
                $this->packageImages = $package->images ? $package->images->toArray() : [];
            }
        }
        
        $this->showDeleteImageModal = false;
        $this->imageToDelete = null;
    }

    public function update()
    {
        $this->validate();

        $package = EventPackage::findOrFail($this->packageId);
        
        $durationInMilliseconds = null;
        if ($this->duration_hours > 0 || $this->duration_minutes > 0) {
            $durationInMilliseconds = ((int)$this->duration_hours * 60 + (int)$this->duration_minutes) * 60 * 1000;
        }
        
        $package->update([
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

        $package = EventPackage::with('images')->find($this->packageId);
        $this->packageImages = $package->images ? $package->images->toArray() : [];
        $this->newImages = [];

        session()->flash('message', 'Package updated successfully!');
        return redirect()->route('admin.event-packages');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.event-package.update-package', [
            'categories' => $this->categories,
        ]);
    }
}