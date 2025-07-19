<?php

namespace App\Livewire\Public\Components;

use App\Models\Category;
use App\Models\EventPackage;
use Livewire\Component;
use Livewire\Attributes\On;

class CategoryPopup extends Component
{
 public $showModal = false;
    public $modalCategory = null;

    protected $listeners = [
        'openSubCategoryPopup' => 'openModal'
    ];

    public function openModal($categorySlug)
    {
        $this->modalCategory = Category::where('slug', $categorySlug)->first();
        $this->showModal = true;
    }

    public function selectCategory($categorySlug)
    {
        // Redirect to packages page with category filter
        return $this->redirect(
            route('event-packages', ['category' => $categorySlug])
            ,
            navigate: true
        );
    }
    public function closeModal()
    {
        $this->showModal = false;
        $this->modalCategory = null;
    }

    public function selectSubCategory($categorySlug, $subCategorySlug)
    {
        // Redirect to packages page with both category and subcategory filters
        return $this->redirect(
            route('event-packages', [
                'category' => $categorySlug,
                'subcategory' => $subCategorySlug
            ]),
            navigate: true // This enables SPA-like navigation
        );
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

    public function render()
    {
        return view('livewire.public.components.category-popup');
    }
}
