<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Show')]
class Show extends Component
{
    public $categories;

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::latest()->get();
    }

    // In your Livewire component class
    public $showDeleteModal = false;
    public $categoryIdToDelete;

    public function confirmDelete($categoryId)
    {
        $this->showDeleteModal = true;
        $this->categoryIdToDelete = $categoryId;
    }

    public function deleteCategory()
    {
        // Perform the deletion
        Category::find($this->categoryIdToDelete)->delete();

        // Close modal and reset
        $this->showDeleteModal = false;
        $this->categoryIdToDelete = null;

        // Optional: Show success message
        session()->flash('message', 'Category deleted successfully');
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->categoryIdToDelete = null;
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.category.show');
    }

}
