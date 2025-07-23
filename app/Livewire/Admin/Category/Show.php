<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Show')]
class Show extends Component
{
    use WithPagination; // Add this trait

    public $confirmingDeletion = false;
    public $categoryToDelete = null;
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage(); // Reset pagination when searching
    }

    public function confirmDelete($categoryId)
    {
        $this->confirmingDeletion = true;
        $this->categoryToDelete = $categoryId;
    }

    public function deleteCategory()
    {
        if ($this->categoryToDelete) {
            $category = Category::find($this->categoryToDelete);
            if ($category) {
                $category->delete();
            }
        }

        $this->confirmingDeletion = false;
        $this->categoryToDelete = null;
        $this->resetPage(); // Reset pagination after deletion
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
        $this->categoryToDelete = null;
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $categories = Category::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->latest()->paginate(8);

        return view('livewire.admin.category.show', compact('categories'));
    }
}