<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of active offers
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Offer::where('is_active', true)
                          ->where('start_date', '<=', now())
                          ->where('end_date', '>=', now())
                          ->get()
        ]);
    }

    /**
     * Store a newly created offer
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'terms_conditions' => 'nullable|string',
        ]);

        $offer = Offer::create($validated);

        return response()->json([
            'success' => true,
            'data' => $offer,
            'message' => 'Offer created successfully'
        ], 201);
    }

    /**
     * Display the specified offer
     */
    public function show(Offer $offer)
    {
        return response()->json([
            'success' => true,
            'data' => $offer
        ]);
    }

    /**
     * Update the specified offer
     */
    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'discount_percentage' => 'sometimes|numeric|min:0|max:100',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
            'is_active' => 'boolean',
            'terms_conditions' => 'nullable|string',
        ]);

        $offer->update($validated);

        return response()->json([
            'success' => true,
            'data' => $offer,
            'message' => 'Offer updated successfully'
        ]);
    }

    /**
     * Remove the specified offer
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Offer deleted successfully'
        ], 204);
    }
}
