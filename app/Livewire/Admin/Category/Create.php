<?php

namespace App\Livewire\Admin\Category;

use App\Helpers\ImageKitHelper;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
#[Title('Create Category')]

class Create extends Component
{
    use WithFileUploads;
    
    public $image;
    public $categories;
    public $currentImageUrl = null;
    public $form = [
        'name' => '',
        'description' => '',
        'parent_id' => null,
        'is_special' => false, 
    ];
    public $editingId = null;
    public $showModal = false;

    protected $rules = [
        'form.name' => 'required|string|max:255|unique:categories,name',
        'form.description' => 'nullable|string',
        'form.parent_id' => 'nullable|exists:categories,id',
        'form.is_special' => 'boolean', 
        'image' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'form.name.required' => 'The category name is required.',
        'form.name.unique' => 'This category already exists.',
        'image.image' => 'Please upload a valid image file.',
        'image.max' => 'Image size must be less than 2MB.',
    ];

    public function loadCategories()
    {
        $this->categories = Category::all();
    }

    #[On('open-create-modal')]
    public function openModal($editId = null)
    {
        $this->resetForm();
        $this->editingId = $editId;

        if ($editId) {
            $category = Category::findOrFail($editId);
            $this->form = [
                'name' => $category->name,
                'description' => $category->description,
                'parent_id' => $category->parent_id,
                'is_special' => (bool) $category->is_special,
            ];
            $this->currentImageUrl = $category->image;
            $this->image = null; // Reset for new upload
            $this->rules['form.name'] = 'required|string|max:255|unique:categories,name,' . $editId;
        } else {
            $this->currentImageUrl = null;
            $this->image = null;
            $this->rules['form.name'] = 'required|string|max:255|unique:categories,name';
        }

        $this->showModal = true;
    }

    public function saveCategory()
    {
        if ($this->editingId) {
            $this->rules['form.name'] = 'required|string|max:255|unique:categories,name,' . $this->editingId;
        }
        
        $this->validate();

        $data = $this->form;
        $message = '';

        if ($this->image) {
            $imageData = ImageKitHelper::uploadImage($this->image, '/Zuppie/CategoryImages');
            
            if ($imageData) {
                if ($this->editingId) {
                    $oldCategory = Category::find($this->editingId);
                    if ($oldCategory && $oldCategory->image_file_id) {
                        ImageKitHelper::deleteImage($oldCategory->image_file_id);
                    }
                }
                
                $data['image'] = $imageData['url'];
                $data['image_file_id'] = $imageData['fileId'];
            } else {
                session()->flash('error', 'Failed to upload image. Please try again.');
                return;
            }
        }

        try {
            if ($this->editingId) {
                $category = Category::find($this->editingId);
                $category->update($data);
                $message = 'Category updated successfully!';
            } else {
                Category::create($data);
                $message = 'Category created successfully!';
            }

            session()->flash('message', $message);
            $this->showModal = false;
            $this->resetForm();
            
            $this->dispatch('category-saved');
            
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->form = [
            'name' => '',
            'description' => '',
            'parent_id' => null,
            'is_special' => false,
        ];
        $this->image = null;
        $this->currentImageUrl = null;
        $this->editingId = null;
        $this->resetValidation();
    }

    public function render()
    {
        $parentCategories = Category::when($this->editingId, function ($query) {
            $query->where('id', '!=', $this->editingId);
        })->whereNull('parent_id')->get(); 

        return view('livewire.admin.category.create', [
            'parentCategories' => $parentCategories
        ]);
    }
}
