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

    public function alertConfirm($id)
    {
        $this->dispatch( 'swal:confirm', type: 'warning', message: 'Are you sure?', text: 'If deleted, you will not be able to recover this', categoryId: $id);

    }
    
    public function delete($id)
    {
        Category::find($id)->delete();
        $this->dispatch('success', __('Category deleted successfully.'));
    }
    
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.category.show');
    }

}
