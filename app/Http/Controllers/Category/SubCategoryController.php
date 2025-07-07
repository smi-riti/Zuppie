<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return response()->json([
            'success' => true,
            'data' => SubCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'parent_id' => 'nullable|exists:sub_categories,id',
            'description' => 'nullable|string',
        ]);
        $sub_category = SubCategory::create($validated);

         return response()->json([
            'success' => true,
            'data' => $sub_category,
            'message' => 'Sub Category created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $sub_category)
    {
         return response()->json([
            'success' => true,
            'data' => $sub_category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $sub_category)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'parent_id' => 'nullable|exists:sub_categories,id',
            'description' => 'nullable|string',
        ]);

        $sub_category->update($validated);

        return response()->json([
            'success' => true,
            'data' => $sub_category,
            'message' => 'Sub-Category updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $sub_category)
    {
        $sub_category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sub-Category deleted successfully'
        ], 204);
    }
}
