<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index()
    {
        $query = Booking::with(['user', 'eventPackage', 'payments']);
        
        // If not admin, only show user's own bookings
        if (!Auth::user()->is_admin) {
            $query->where('user_id', Auth::id());
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }

    /**
     * Store a newly created booking
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_package_id' => 'required|exists:event_packages,id',
            'event_date' => 'required|date|after:today',
            'guest_count' => 'required|integer|min:1',
            'special_requests' => 'nullable|string|max:1000',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'required|email',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['booking_status'] = 'pending';

        $booking = Booking::create($validated);

        return response()->json([
            'success' => true,
            'data' => $booking->load(['user', 'eventPackage']),
            'message' => 'Booking created successfully'
        ], 201);
    }

    /**
     * Display the specified booking
     */
    public function show(Booking $booking)
    {
        // Check if user can view this booking
        if (!Auth::user()->is_admin && $booking->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access to booking'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $booking->load(['user', 'eventPackage', 'payments'])
        ]);
    }

    /**
     * Update the specified booking
     */
    public function update(Request $request, Booking $booking)
    {
        // Check if user can update this booking
        if (!Auth::user()->is_admin && $booking->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access to booking'
            ], 403);
        }

        $validated = $request->validate([
            'event_date' => 'sometimes|date|after:today',
            'guest_count' => 'sometimes|integer|min:1',
            'special_requests' => 'nullable|string|max:1000',
            'contact_phone' => 'sometimes|string|max:20',
            'contact_email' => 'sometimes|email',
            'booking_status' => 'sometimes|in:pending,confirmed,cancelled,completed',
        ]);

        // Only admin can change booking status
        if (isset($validated['booking_status']) && !Auth::user()->is_admin) {
            unset($validated['booking_status']);
        }

        $booking->update($validated);

        return response()->json([
            'success' => true,
            'data' => $booking->load(['user', 'eventPackage', 'payments']),
            'message' => 'Booking updated successfully'
        ]);
    }

    /**
     * Cancel the specified booking
     */
    public function destroy(Booking $booking)
    {
        // Check if user can cancel this booking
        if (!Auth::user()->is_admin && $booking->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access to booking'
            ], 403);
        }

        $booking->update(['booking_status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'message' => 'Booking cancelled successfully'
        ]);
    }
}
