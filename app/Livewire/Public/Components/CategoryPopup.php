<?php

namespace App\Livewire\Public\Components;

use App\Models\Category;
use App\Models\EventPackage;
use Livewire\Component;
use Livewire\Attributes\On;

class CategoryPopup extends Component
{
    public $isOpen = false;
    public $selectedCategory = null;
    public $subcategories = [];
    public $selectedSubcategory = null;
    public $packages = [];
    public $similarPackages = [];

    #[On('openCategoryPopup')]
    public function openPopup($categoryId)
    {
        $this->selectedCategory = Category::with('children')->find($categoryId);
        if ($this->selectedCategory) {
            $this->subcategories = $this->selectedCategory->children;
            $this->isOpen = true;
            $this->selectedSubcategory = null;
            $this->packages = [];
            $this->similarPackages = [];
        }
    }

    public function closePopup()
    {
        $this->isOpen = false;
        $this->reset(['selectedCategory', 'subcategories', 'selectedSubcategory', 'packages', 'similarPackages']);
    }

    public function selectSubcategory($subcategoryId)
    {
        $this->selectedSubcategory = Category::find($subcategoryId);
        
        // Get packages for selected subcategory
        $this->packages = EventPackage::with(['images', 'category'])
            ->where('category_id', $subcategoryId)
            ->where('is_active', true)
            ->get();

        // Get similar packages from the same parent category but different subcategories
        if ($this->selectedCategory && $this->selectedSubcategory) {
            $this->similarPackages = EventPackage::with(['images', 'category'])
                ->whereHas('category', function($query) {
                    $query->where('parent_id', $this->selectedCategory->id)
                          ->where('id', '!=', $this->selectedSubcategory->id);
                })
                ->where('is_active', true)
                ->take(6)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.public.components.category-popup');
    }
}
