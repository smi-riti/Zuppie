<?php

namespace App\Livewire\Admin\Category;

use App\Helpers\ImageKitHelper;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Show')]
class Show extends Component
{
    use WithPagination;

    public $confirmingDeletion = false;
    public $categoryToDelete = null;
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[On('category-saved')]
    public function refreshComponent()
    {
        $this->resetPage();
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
                if ($category->image_file_id) {
                    ImageKitHelper::deleteImage($category->image_file_id);
                }
                $category->delete();
                session()->flash('message', 'Category deleted successfully!');
            }
        }

        $this->confirmingDeletion = false;
        $this->categoryToDelete = null;
        $this->resetPage();
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
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        })->with('parent')->latest()->paginate(7);

        return view('livewire.admin.category.show', compact('categories'));
    }
}