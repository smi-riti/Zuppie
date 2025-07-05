<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageCategories extends Component
{
    public $categories;
    public $form = [
        'name' => '',
        'description' => ''
    ];
    public $editingId = null;
    public $showModal = false;

    public $confirmingDeletion = false;
    public $categoryToDelete = null;

    protected $rules = [
        'form.name' => 'required|string|max:255|unique:categories,name',
        'form.description' => 'nullable|string'
    ];

    protected $messages = [
        'form.name.required' => 'The category name is required.',
        'form.name.unique' => 'This category already exists.'
    ];

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::all();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.category.manage-categories');
    }


    public function openModal($editId = null)
    {
        $this->resetForm();
        $this->editingId = $editId;

        if ($editId) {
            $category = Category::findOrFail($editId);
            $this->form = [
                'name' => $category->name,
                'description' => $category->description
            ];
            $this->rules['form.name'] = 'required|string|max:255|unique:categories,name,' . $editId;
        }

        $this->showModal = true;
    }

    public function saveCategory()
    {
        $this->validate();

        if ($this->editingId) {
            Category::find($this->editingId)->update($this->form);
            $message = 'Category updated successfully!';
        } else {
            Category::create($this->form);
            $message = 'Category created successfully!';
        }

        $this->showModal = false;
        $this->resetForm();
        $this->loadCategories();
        session()->flash('status', $message);
    }


    public function confirmDelete($categoryId)
    {
        $this->confirmingDeletion = true;
        $this->categoryToDelete = $categoryId;
    }

    public function deleteCategory()
    {
        Category::find($this->categoryToDelete)->delete();

        $this->confirmingDeletion = false;
        $this->categoryToDelete = null;
        $this->loadCategories();

    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
        $this->categoryToDelete = null;
    }

    public function resetForm()
    {
        $this->form = ['name' => '', 'description' => ''];
        $this->editingId = null;
        $this->resetValidation();
    }
}