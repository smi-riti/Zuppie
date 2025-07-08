<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $categories;
    public $form = [
        'name' => '',
        'description' => ''
    ];
    public $editingId = null;
    public $showModal = false;
    protected $rules = [
        'form.name' => 'required|string|max:255|unique:categories,name',
        'form.description' => 'nullable|string'
    ];

    protected $messages = [
        'form.name.required' => 'The category name is required.',
        'form.name.unique' => 'This category already exists.'
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
            $this->loadCategories();

        } else {
            Category::create($this->form);
            $message = 'Category created successfully!';
            $this->loadCategories();

        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('status', $message);
    }
    public function resetForm()
    {
        $this->form = ['name' => '', 'description' => ''];
        $this->editingId = null;
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.admin.category.create');
    }
}
