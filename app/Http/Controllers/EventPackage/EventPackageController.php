<?php

namespace App\Http\Controllers\EventPackage;

use App\Http\Controllers\Controller;
use App\Models\EventPackage;
use Illuminate\Http\Request;

class EventPackageController extends Controller
{
    /**
     * Display a listing of event packages
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => EventPackage::with(['category', 'images'])->get()
        ]);
    }

    /**
     * Store a newly created event package
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'duration_hours' => 'nullable|integer|min:1',
            'max_guests' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $eventPackage = EventPackage::create($validated);

        return response()->json([
            'success' => true,
            'data' => $eventPackage->load(['category', 'images']),
            'message' => 'Event package created successfully'
        ], 201);
    }

    /**
     * Display the specified event package
     */
    public function show(EventPackage $eventPackage)
    {
        return response()->json([
            'success' => true,
            'data' => $eventPackage->load(['category', 'images'])
        ]);
    }

    /**
     * Update the specified event package
     */
    public function update(Request $request, EventPackage $eventPackage)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'category_id' => 'sometimes|exists:categories,id',
            'duration_hours' => 'nullable|integer|min:1',
            'max_guests' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $eventPackage->update($validated);

        return response()->json([
            'success' => true,
            'data' => $eventPackage->load(['category', 'images']),
            'message' => 'Event package updated successfully'
        ]);
    }

    /**
     * Remove the specified event package
     */
    public function destroy(EventPackage $eventPackage)
    {
        $eventPackage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event package deleted successfully'
        ], 204);
    }
}
