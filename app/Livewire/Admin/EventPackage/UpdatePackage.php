<?php

namespace App\Livewire\Admin\EventPackage;

use Livewire\Component;
use App\Models\EventPackage;
use App\Models\Category;   
use Livewire\WithFileUploads; 
use App\Helpers\ImageKitHelper;
class UpdatePackage extends Component
{ 
  
    use WithFileUploads;

    public $packageId, $category_id, $name, $price, $discount_type, $discount_value, $description, $is_active, $is_special;
    public $categories = [];
    public $newImages = [];
    public $packageImages = [];
    
    // Duration form fields
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
        // Ensure we have an array of images
        $this->packageImages = $package->images ? $package->images->toArray() : [];
        $this->is_active = $package->is_active;
        $this->is_special = $package->is_special;
        
        // Convert duration from milliseconds to hours and minutes for form display
        if ($package->duration) {
            $totalMinutes = floor($package->duration / (1000 * 60)); // Convert ms to minutes
            $this->duration_hours = floor($totalMinutes / 60);
            $this->duration_minutes = $totalMinutes % 60;
        } else {
            $this->duration_hours = 0;
            $this->duration_minutes = 0;
        }
        
        $this->categories = Category::all()->pluck('name', 'id')->toArray();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'discount_type' && empty($this->discount_type)) {
            $this->discount_value = null;
        }
    }

    public function removeImage($imageId)
    {
        $image = \App\Models\EventPackageImage::find($imageId);
        if ($image) {
            if ($image->image_file_id) {
                ImageKitHelper::deleteImage($image->image_file_id);
            }
            $image->delete();

            // Refresh the packageImages array
            $this->packageImages = EventPackage::find($this->packageId)->images->toArray();
        }
    }

    public function update()
    {
        $this->validate();

        $package = EventPackage::findOrFail($this->packageId);
        
        // Convert hours and minutes to milliseconds
        $durationInMilliseconds = null;
        if ($this->duration_hours > 0 || $this->duration_minutes > 0) {
            // Convert to milliseconds: (hours * 60 + minutes) * 60 * 1000
            $durationInMilliseconds = ((int)$this->duration_hours * 60 + (int)$this->duration_minutes) * 60 * 1000;
        }
        
        // Update package details
        $package->update([
            'category_id' => $this->category_id ?: null,
            'name' => $this->name,
            'price' => $this->price,
            'discount_type' => $this->discount_type ?: null,
            'discount_value' => $this->discount_type ? $this->discount_value : null,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'is_special' => $this->is_special,
            'duration' => $durationInMilliseconds,
        ]);

        // Track successful and failed uploads
        $successfulUploads = 0;
        $failedUploads = 0;

        // Handle new images
        if ($this->newImages) {
            foreach ($this->newImages as $image) {
                if ($image) {
                    try {
                        // Verify it's an image file before attempting upload
                        $mimeType = $image->getMimeType();
                        $validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/svg+xml', 'image/webp'];
                        
                        if (!in_array($mimeType, $validImageTypes)) {
                            $failedUploads++;
                            continue;
                        }
                        
                        $upload = ImageKitHelper::uploadImage($image, '/Zuppie/PackageImages');
                        if ($upload) {
                            $package->images()->create([
                                'image_url' => $upload['url'],
                                'image_file_id' => $upload['fileId'],
                            ]);
                            $successfulUploads++;
                        } else {
                            $failedUploads++;
                        }
                    } catch (\Exception $e) {
                        \Log::error('Failed to upload package image: ' . $e->getMessage());
                        $failedUploads++;
                    }
                }
            }
        }

        // Refresh the packageImages array safely
        $package = EventPackage::find($this->packageId);
        if ($package && $package->images) {
            $this->packageImages = $package->images->toArray();
        } else {
            $this->packageImages = [];
        }
        $this->newImages = []; // Clear uploaded images

        $this->dispatch('packageUpdated');
        $this->dispatch('closeUpdateModal');
        
        $message = 'Package updated successfully!';
        if ($successfulUploads > 0) {
            $message .= " {$successfulUploads} images uploaded.";
        }
        if ($failedUploads > 0) {
            $message .= " {$failedUploads} image uploads failed.";
        }
        
        session()->flash('message', $message);
    }


    public function render()
    {
        return view('livewire.admin.event-package.update-package', [
            'categories' => $this->categories,
        ]);
    }
}
