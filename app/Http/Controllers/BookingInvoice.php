<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BookingInvoice extends Controller
{
    public function downloadInvoice($invoiceId)
    {
        // Load the booking with its user and event package
        $booking = Booking::with(['user', 'eventPackage'])->findOrFail($invoiceId);
        $user = $booking->user;
        // Assume items is an array containing the event package for simplicity
        $items = [$booking->eventPackage]; // Convert to array for iteration in Blade
        $total = $booking->total_price; // Use total_price from Booking model

        // Generate the PDF
        $pdf = Pdf::loadView('invoices.show', compact('booking', 'user', 'items', 'total'));

        // Download the PDF
        return $pdf->download('invoice-' . $invoiceId . '.pdf');
    }
}