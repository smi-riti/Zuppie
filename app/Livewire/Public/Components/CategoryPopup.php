<?php

namespace App\Livewire\Public\Components;

use App\Models\Category;
use Livewire\Component;

class CategoryPopup extends Component
{
    public $showModal = false;
    public $modalCategory = null;

    protected $listeners = ['openCategoryModal'];

    public function openCategoryModal($categorySlug)
    {
        $this->modalCategory = Category::with('children')->where('slug', $categorySlug)->first();
        
        // If no subcategories, redirect directly to filter page
        if (!$this->modalCategory || $this->modalCategory->children->count() === 0) {
            return redirect()->route('event-package.filter', [
                'category' => $categorySlug
            ]);
        }
        
        $this->showModal = true;
    }

    public function getCategoryIcon($slug)
    {
        $icons = [
            'birthday' => 'fas fa-birthday-cake',
            'wedding-anniversary' => 'fas fa-heart',
            'festival' => 'fas fa-star',
            '1st-birthday' => 'fas fa-baby',
            'haldi-mehndi' => 'fas fa-flower',
            'premium-decoration' => 'fas fa-crown',
            'flower-bouquet' => 'fas fa-seedling',
            'gift-section' => 'fas fa-gift',
            'love-theme' => 'fas fa-heart',
            'bride-to-be' => 'fas fa-ring'
        ];

        return $icons[$slug] ?? 'fas fa-star';
    }

    public function selectSubCategory($categorySlug, $subCategorySlug)
    {
        $this->showModal = false;
        return redirect()->route('event-package.filter', [
            'category' => $categorySlug,
            'subcategory' => $subCategorySlug
        ]);
    }

    public function selectCategory($categorySlug)
    {
        $this->showModal = false;
        return redirect()->route('event-package.filter', [
            'category' => $categorySlug
        ]);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->modalCategory = null;
    }

    public function render()
    {
        return view('livewire.public.components.category-popup');
    }
}
