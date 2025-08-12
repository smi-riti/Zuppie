<?php

namespace App\Livewire\Public\Section;

use App\Models\Blog;
use App\Models\Category;
use App\Models\EventPackage;
use Livewire\Component;

class Homepage extends Component
{
    

    
    public function render()
    {
        // Get 9 categories (first special ones, then regular ones)
        $categories = Category::where('parent_id', null)
            ->orderByDesc('is_special')
            ->orderBy('created_at')
            ->limit(9)
            ->get();

        // Get 6 event packages (first special ones, then regular ones)
        $packages = EventPackage::with(['category', 'images'])
            ->where('is_active', true)
            ->orderByDesc('is_special')
            ->orderBy('created_at')
            ->limit(6)
            ->get();

        // Define gradient colors for categories
        $gradientColors = [
            'from-pink-600 to-purple-600',
            'from-blue-600 to-indigo-600',
            'from-green-600 to-teal-600',
            'from-yellow-600 to-orange-600',
            'from-purple-600 to-pink-600',
            'from-indigo-600 to-blue-600',
            'from-teal-600 to-green-600',
            'from-orange-600 to-red-600',
            'from-red-600 to-pink-600'
        ];

        // Define category icons
        $categoryIcons = [
            'fas fa-birthday-cake',
            'fas fa-heart',
            'fas fa-briefcase',
            'fas fa-ring',
            'fas fa-baby',
            'fas fa-graduation-cap',
            'fas fa-snowflake',
            'fas fa-mask',
            'fas fa-hands-helping'
        ];
        $blogs = Blog::latest()->take(3)->get();

        return view('livewire.public.section.homepage', [
            'categories' => $categories,
            'packages' => $packages,
            'gradientColors' => $gradientColors,
            'categoryIcons' => $categoryIcons,
            'blogs' => $blogs
        ]);
    }
}