<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Show')]
class Show extends Component
{
    public $confirmingDeletion = false;
    public $categoryToDelete = null;
    public $categories;

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::latest()->get();
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
    
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.category.show');
    }

}
