<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


 
class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
   public function index()
{
    return response()->json([
        'success' => true,
        'data' => Category::all()
    ]);
}

    /**
     * Create a new category
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'is_special' => 'boolean',
            'image' => 'nullable|string',
            'image_file_id' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Category created successfully'
        ], 201);
    }

    /**
     * Display a specific category
     */
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    /**
     * Update a category
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'is_special' => 'boolean',
            'image' => 'nullable|string',
            'image_file_id' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Category updated successfully'
        ]);
    }

    /**
     * Delete a category
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ], 204);
    }
}